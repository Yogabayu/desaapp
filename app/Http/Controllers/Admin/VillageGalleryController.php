<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillageGallery;
use App\Http\Requests\StoreVillageGalleryRequest;
use App\Http\Requests\UpdateVillageGalleryRequest;
use App\Models\GeneralInfo;
use App\Models\TypeGalery;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VillageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = VillageGallery::with('type_gallery')->orderBy('id', 'desc')->get();
            return view('pages.admin.gallery.index', compact('data'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $types = TypeGalery::all();
            return view('pages.admin.gallery.create', compact('types'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVillageGalleryRequest $request)
    {
        try {
            DB::beginTransaction();
            $village = GeneralInfo::first();

            $villageGallery = new VillageGallery();
            $villageGallery->village_id = $village->id;
            $villageGallery->type_gallery_id = $request->type_gallery_id;
            $villageGallery->name = $request->name;
            $villageGallery->desc = $request->desc;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('gallery', $image->hashName(), 'public');
                $villageGallery->image = $image->hashName();
            }

            $villageGallery->is_show = $request->is_show;
            $villageGallery->save();

            DB::commit();
            return redirect()->route('galery.index')->with('success', 'Village Gallery created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VillageGallery $villageGallery)
    {
        try {
            return view('pages.admin.gallery.show', compact('villageGallery'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VillageGallery $villageGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVillageGalleryRequest $request, VillageGallery $villageGallery)
    {
        try {
            $villageGallery->village_id = $request->village_id;
            $villageGallery->type_gallery_id = $request->type_gallery_id;
            $villageGallery->name = $request->name;
            $villageGallery->desc = $request->desc;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('gallery', $image->hashName(), 'public');
                $villageGallery->image = $image->hashName();
            }
            $villageGallery->boolean = $request->boolean;
            $villageGallery->save();
            return back()->with('success', 'Village Gallery updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $gallery = VillageGallery::where('id', $id)->firstOrFail();

            if ($gallery->image) {
                $image_path = public_path('storage/gallery/' . $gallery->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Gallery deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function toggleShowGallery(Request $request)
    {
        try {
            $gallery = VillageGallery::find($request->gallery_id); // Access 'gallery_id' 
            if ($gallery) {
                $gallery->is_show = !$gallery->is_show;
                $gallery->save();
                return response()->json(['status' => true, 'message' => 'Gallery toggled successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Gallery not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
