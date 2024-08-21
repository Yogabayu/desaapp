<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $generalInfo = GeneralInfo::first();
            return view('pages.admin.general-info.show', compact('generalInfo'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $generalInfo = GeneralInfo::first();
            return view('pages.admin.general-info.show', compact('generalInfo'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralInfo $generalInfo)
    {
        try {
            return view('pages.admin.general-info.edit', compact('generalInfo'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralInfo $generalInfo)
    {
        try {
            // dd($request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'email' => 'required|email',
                'tlp' => 'required|string',
                'area' => 'required|numeric',
                'total_population' => 'required|numeric',
                'fb' => 'nullable|string|max:255',
                'wa' => 'nullable|string|max:255',
                'ig' => 'nullable|string|max:255',
                'ytb' => 'nullable|string|max:255',
                'web' => 'nullable|url',
                'long_desc' => 'required|string',
                'short_desc' => 'required|string',
                'fasilities' => 'required|string',
                'general_work' => 'required|string',
                'visi' => 'required|string',
                'misi' => 'required|string',
                'general_image' => 'nullable|image|max:2048',
                'logo' => 'nullable|image|max:2048',
            ]);

            // Handle image uploads
            if ($request->hasFile('general_image')) {
                // Delete the old image if it exists
                if ($generalInfo->general_image) {
                    Storage::disk('public')->delete('general_info/' . $generalInfo->general_image);
                }

                $file = $request->file('general_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('general_info', $filename, 'public');
                $generalInfo->general_image = $filename;
            }

            if ($request->hasFile('logo')) {
                // Delete the old logo if it exists
                if ($generalInfo->logo) {
                    Storage::disk('public')->delete('general_info/' . $generalInfo->logo);
                }

                $file = $request->file('logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('general_info', $filename, 'public');
                $generalInfo->logo = $filename;
            }

            $generalInfo->update($request->except(['general_image', 'logo']));

            return redirect()->route('general-info.index', $generalInfo->slug)
                ->with('success', 'Data Desa berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
