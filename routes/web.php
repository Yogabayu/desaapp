<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('guest.home');
    Route::get('profile', [MainController::class, 'profile']);
    Route::get('galeri', [MainController::class, 'galeri']);
    Route::get('article', [MainController::class, 'article']);
});

Route::prefix('admin')->group(function () {
    Route::get('login',[AuthController::class, 'index']);
    Route::post('login',[AuthController::class, 'login'])->name('auth.login');
    Route::post('logout',[AuthController::class, 'logout'])->name('auth.logout'); 

    Route::middleware('auth')->group(function () {
        Route::get('dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

        //profile
        Route::get('profile',[ProfileController::class, 'index'])->name('admin.profile');
    });
});