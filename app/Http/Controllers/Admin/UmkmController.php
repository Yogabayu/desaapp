<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Support\Str;
use App\Models\GeneralInfo;
use App\Models\UmkmImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $umkm = Umkm::query()->orderBy('created_at', 'desc');

                return DataTables::of($umkm)
                    ->addIndexColumn()
                    ->editColumn('is_active', function ($umkm) {
                        $class = $umkm->is_active == 1 ? 'badge-success' : 'badge-warning';
                        return '<span class="badge ' . $class . '">' . ucfirst($umkm->is_active == 1 ? 'Ditampilkan' : 'Disembunyikan') . '</span>';
                    })
                    ->addColumn('action', function ($umkm) {
                        return view('pages.admin.umkm.components.button', compact('umkm'))->render();
                    })
                    ->rawColumns(['is_active', 'action'])
                    ->make(true);
            }

            return view('pages.admin.umkm.index');
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
            return view('pages.admin.umkm.store');
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
                'desc' => 'required',
                'tlp' => 'required',
                'fb' => 'nullable',
                'ig' => 'nullable',
                'is_active' => 'required',
                'images' => 'array|required_if:images.*,!', // Validasi untuk array gambar
                'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk setiap gambar
            ], [
                'required' => ':attribute harus diisi',
                'images.required' => 'Setidaknya satu gambar harus diunggah',
                'images.*.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif, svg',
                'images.*.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            DB::beginTransaction();
            $village = GeneralInfo::first();

            $umkm = new Umkm();
            $umkm->village_id = $village->id;
            $umkm->name = $request->name;
            $umkm->slug = Str::slug($request->name);
            $umkm->desc = $request->desc;
            $umkm->tlp = $request->tlp;

            if ($request->fb) {
                $umkm->fb = $request->fb;
            }

            if ($request->ig) {
                $umkm->ig = $request->ig;
            }

            $umkm->is_active = $request->is_active;
            $umkm->save();

            // Proses upload gambar            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageUmkm = new UmkmImage();
                    $imageUmkm->umkm_id = $umkm->id;
                    $image->storeAs('umkm_images', $image->hashName(), 'public');
                    $imageUmkm->image = $image->hashName();
                    $imageUmkm->save();
                }
            }

            DB::commit();
            return back()->with('success', 'Umkm created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $umkm = Umkm::where('slug', $slug)->with('village', 'images')->first();
            $reviews = $umkm->reviews()->paginate(10);

            return view('pages.admin.umkm.show', compact('umkm', 'reviews'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function loadMore(Request $request)
    {
        $umkm = Umkm::findOrFail($request->umkm_id);
        $reviews = $umkm->reviews()->paginate(10); // Adjust the number as needed

        $view = view('pages.admin.umkm.components.review', compact('reviews'))->render();

        return response()->json([
            'html' => $view,
            'last_page' => $reviews->lastPage()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        try {
            DB::beginTransaction();

            $umkm->fill($request->except('images'));
            $umkm->save();

            // Proses upload gambar baru jika ada
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageUmkm = new UmkmImage();
                    $imageUmkm->umkm_id = $umkm->id;
                    $image->storeAs('umkm_images', $image->hashName(), 'public');
                    $imageUmkm->image = $image->hashName();
                    $imageUmkm->save();
                }
            }

            // Proses penghapusan gambar jika ada
            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $imageId) {
                    $image = UmkmImage::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete('umkm_images/' . $image->image);
                        $image->delete();
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'UMKM updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        try {
            DB::beginTransaction();

            // Hapus gambar-gambar terkait dari storage
            foreach ($umkm->images as $image) {
                Storage::disk('public')->delete('umkm_images/' . $image->image);
            }

            // Hapus record gambar dari database
            $umkm->images()->delete();

            // Hapus UMKM
            $umkm->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'UMKM berhasil di hapus'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function toggleShowUmkmReview(Request $request)
    {
        try {
            $umkm = Umkm::where('slug', $request->slug)->first();
            // return response()->json(['status' => false, 'message' => $umkm], 404);
            if ($umkm) {
                $umkm->is_active = !$umkm->is_active;
                $umkm->save();
                return response()->json(['status' => true, 'message' => 'Status updated successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
