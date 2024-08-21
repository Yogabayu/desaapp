<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userActive = User::where('isActive', true)->count();
        $userInactive = User::where('isActive', false)->count();
        $role = Role::count();

        return view('pages.admin.dashboard', compact('userActive', 'userInactive', 'role'));
    }
}
