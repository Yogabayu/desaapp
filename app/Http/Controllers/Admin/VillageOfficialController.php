<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralInfo;
use App\Models\VillageOfficial;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class VillageOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VillageOfficial::query()->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('village.name', function (VillageOfficial $official) {
                    return $official->village->name;
                })
                ->addColumn('image', function (VillageOfficial $official) {
                    return '<img src="' . asset('storage/official/' . $official->image) . '"alt="' . $official->name . '" class="img-thumbnail" style="width: 50px; height: 50px;">';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('officials.edit', $row->slug);

                    $editBtn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<button onclick="deleteOfficial(\'' . $row->slug . '\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>';
                
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions', 'village.name','image']) // Specify both columns
                ->make(true);
        }
        // Return your view if it's not an AJAX request
        return view('pages.admin.village-official.index', ['data' => VillageOfficial::with('village')->orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.admin.village-official.store');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'image.required' => 'Image is required',
                'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
                'image.max' => 'Image size must be less than 2MB',
                'name.required' => 'Name is required',
                'position.required' => 'Position is required',
            ]);

            $village = GeneralInfo::first();

            DB::beginTransaction();
            $official = new VillageOfficial();
            $official->village_id = $village->id;
            $official->slug = Str::slug($request->name);
            $official->name = $request->name;
            $official->position = $request->position;

            $image = $request->file('image');
            $image->storeAs('official', $image->hashName(),'public');
            $official->image = $image->hashName();
            
            $official->save();
            DB::commit();

            //kemabli keroute
            return redirect()->route('officials.index')->with('success', 'Village Official created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('officials.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = VillageOfficial::where('slug', $id)->firstOrFail();
            return view('pages.admin.village-official.edit', ['data' => $data]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
                'image.max' => 'Image size must be less than 2MB',
                'name.required' => 'Name is required',
                'position.required' => 'Position is required',
            ]);

            DB::beginTransaction();

            $official = VillageOfficial::where('slug', $id)->firstOrFail();
            $official->name = $request->name;
            $official->position = $request->position;

            if ($request->hasFile('image')) {
                if ($official->image) {
                    // Delete the image from storage
                    Storage::disk('public')->delete('official/' . $official->image);
                }
                $image = $request->file('image');
                $image->storeAs('official', $image->hashName(),'public');
                $official->image = $image->hashName();
            }
            
            $official->save();
            DB::commit();

            //kemabli keroute
            return redirect()->route('officials.index')->with('success', 'Village Official created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug) {
        try {
            // Find the official using the slug
            $official = VillageOfficial::where('slug', $slug)->firstOrFail(); 
            
            DB::beginTransaction();

            if ($official->image) {
                // Delete the image from storage
                Storage::disk('public')->delete('official/' . $official->image);
            }

            $official->delete(); // Use the delete() method on the model
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Village Official deleted successfully']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'Official not found.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $th->getMessage()]);
        }
    }
}
