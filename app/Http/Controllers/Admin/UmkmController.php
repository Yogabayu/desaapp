<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\UmkmImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Umkm::all();
            dd($data);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmkmRequest $request)
    {
        try {            
            DB::beginTransaction();
            $umkm = new Umkm();
            $umkm->fill($request->all());
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
    public function show(Umkm $umkm)
    {
        try {
            dd($umkm);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
    public function update(UpdateUmkmRequest $request, Umkm $umkm)
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
            return back()->with('success', 'UMKM deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Error deleting UMKM: ' . $th->getMessage());
        }
    }
}
