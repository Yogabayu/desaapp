<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apbd;
use App\Http\Requests\StoreApbdRequest;
use App\Http\Requests\UpdateApbdRequest;
use Illuminate\Support\Facades\DB;

class ApbdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Apbd::all();
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
    public function store(StoreApbdRequest $request)
    {
        try {
            DB::beginTransaction();

            $apbd = new Apbd();
            $apbd->village_id = $request->village_id;
            $apbd->description = $request->description;
            $apbd->amount = $request->amount;
            $apbd->date = $request->date;
            $apbd->type = $request->type;
            $apbd->save();

            DB::commit();
            return back()->with('success', 'Data Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Apbd $apbd)
    {
        try {
            dd($apbd);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apbd $apbd) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApbdRequest $request, Apbd $apbd)
    {
        try {
            DB::beginTransaction();

            $apbd->village_id = $request->village_id;
            $apbd->description = $request->description;
            $apbd->amount = $request->amount;
            $apbd->date = $request->date;
            $apbd->type = $request->type;
            $apbd->save();

            DB::commit();
            return back()->with('success', 'Data Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apbd $apbd)
    {
        try {
            DB::beginTransaction();
            $apbd->delete();
            DB::commit();
            return back()->with('success', 'Apbd deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
