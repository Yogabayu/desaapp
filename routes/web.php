<?php

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
    Route::get('/', [MainController::class, 'index']);
    Route::get('profile', [MainController::class, 'profile']);
    Route::get('galeri', [MainController::class, 'galeri']);
    Route::get('article', [MainController::class, 'article']);
});

