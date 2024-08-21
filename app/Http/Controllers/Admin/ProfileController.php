<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.admin.profile');
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
            $userId = auth()->id(); // Mengambil ID pengguna yang sedang login

            $request->validate([
                'name' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($userId),
                ],
                'nip' => [
                    'required',
                    Rule::unique('users')->ignore($userId),
                ],
            ],[
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'nip.required' => 'NIP harus diisi',
                'nip.unique' => 'NIP sudah terdaftar',
            ]);

            $user = User::findOrFail($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->nip = $request->nip;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                Auth::logout();
                return redirect('/admin/login')->with('success', 'Anda mengganti password silahkan login kembali');
            }
            $user->save();


            return back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
