<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillageGallery;
use App\Http\Requests\StoreVillageGalleryRequest;
use App\Http\Requests\UpdateVillageGalleryRequest;

class VillageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = VillageGallery::all();

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVillageGalleryRequest $request)
    {
        try {
            $villageGallery = new VillageGallery();
            $villageGallery->village_id = $request->village_id;
            $villageGallery->type_gallery_id = $request->type_gallery_id;
            $villageGallery->name = $request->name;
            $villageGallery->desc = $request->desc;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('gallery', $image->hashName(),'public');
                $villageGallery->image = $image->hashName();
            }

            $villageGallery->boolean = $request->boolean;
            $villageGallery->save();
            return back()->with('success', 'Village Gallery created successfully');
        } catch (\Throwable $th) {
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
                $image->storeAs('gallery', $image->hashName(),'public');
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
    public function destroy(VillageGallery $villageGallery)
    {
        try {
            $villageGallery->delete();
            return back()->with('success', 'Village Gallery deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
