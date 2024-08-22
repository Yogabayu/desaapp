<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmkmReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = UmkmReview::all();
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'umkm_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'review' => 'required',
            ],[
                'umkm_id.required' => 'Umkm ID harus diisi',
                'name.required' => 'Name harus diisi',
                'email.required' => 'Email harus diisi',
                'review.required' => 'Review harus diisi',
            ]);

            $umkmReview = new UmkmReview();
            $umkmReview->fill($request->all());
            $umkmReview->save();

            DB::commit();
            return back()->with('success', 'Umkm review created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UmkmReview $umkmReview)
    {
        try {
            dd($umkmReview);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UmkmReview $umkmReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UmkmReview $umkmReview)
    {
        try {
            $request->validate([
                'umkm_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'review' => 'required',
            ],[
                'umkm_id.required' => 'Umkm ID harus diisi',
                'name.required' => 'Name harus diisi',
                'email.required' => 'Email harus diisi',
                'review.required' => 'Review harus diisi',
            ]);
            DB::beginTransaction();

            $umkmReview->fill($request->all());
            $umkmReview->save();

            DB::commit();
            return back()->with('success', 'Umkm review updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UmkmReview $umkmReview)
    {
        try {
            DB::beginTransaction();
            $umkmReview->delete();
            DB::commit();
            return back()->with('success', 'Umkm review deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
