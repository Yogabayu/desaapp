<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $general = GeneralInfo::first();
        return view('pages.auth.login', compact('general'));
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'text' => 'required',
                'password' => 'required'
            ]);

            // cek active
            $user = User::where('email', $request->text)->orWhere('nip', $request->text)->first();
            if (!$user->isActive) {
                return back()->withErrors(['text' => 'Akun anda sedang tidak aktif.'])->withInput($request->except('password'));
            }

            $loginField = filter_var($request->text, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

            $user = User::where($loginField, $request->text)->first();

            if (!$user || !Auth::attempt([$loginField => $request->text, 'password' => $request->password])) {
                return back()->withErrors([
                    'text' => 'The provided credentials do not match our records.',
                ])->withInput($request->except('password'));
            }

            // Login successful
            return redirect()->intended('/admin/dashboard')->with('success', 'Login successfully');  // Adjust this to your needs

        } catch (\Exception $th) {
            return back()->withErrors(['error' => $th->getMessage()])->withInput($request->except('password'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login')->with('success', 'Logout successfully');
    }
}