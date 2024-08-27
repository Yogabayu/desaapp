<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeGalery;
use App\Http\Requests\StoreTypeGaleryRequest;
use App\Http\Requests\UpdateTypeGaleryRequest;
use Illuminate\Support\Facades\DB;

class TypeGaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = TypeGalery::all();
            dd($data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
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
    public function store(StoreTypeGaleryRequest $request)
    {
        try {
            DB::beginTransaction();
            $typeGalery = new TypeGalery();
            $typeGalery->name = $request->name;
            $typeGalery->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'type' => $typeGalery
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeGalery $typeGalery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeGalery $typeGalery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeGaleryRequest $request, TypeGalery $typeGalery)
    {
        try {
            $typeGalery->name = $request->name;
            $typeGalery->save();
            return back()->with('success', 'Type Galery updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeGalery $typeGalery)
    {
        try {
            $typeGalery->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false]);
        }
    }
}
