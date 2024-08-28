<?php

use App\Http\Controllers\Admin\ApbdController;
use App\Http\Controllers\Admin\ArticleCommentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralInfoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TypeGaleryController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\UmkmReviewController;
use App\Http\Controllers\Admin\VillageGalleryController;
use App\Http\Controllers\Admin\VillageOfficialController;
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
// Route::middleware('guest')->group(function () {
Route::get('/', [MainController::class, 'index'])->name('guest.home');
Route::get('profile', [MainController::class, 'profile']);
Route::get('galeri', [MainController::class, 'galeri']);
Route::get('article', [MainController::class, 'article']);
// });

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //profile
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('profile', [ProfileController::class, 'store'])->name('admin.profile.store');

        //generalInfo
        Route::resource('general-info', GeneralInfoController::class);

        //officials
        Route::resource('officials', VillageOfficialController::class);

        //galery
        Route::resource('galery', VillageGalleryController::class);
        Route::post('/admin/galery/toggle-show', [VillageGalleryController::class, 'toggleShowGallery'])->name('galery.toggle-show');

        //type-galery
        Route::resource('type-galery', TypeGaleryController::class);

        //articles
        Route::resource('articles', ArticleController::class);
        ///comments
        Route::resource('comments', ArticleCommentController::class);
        Route::post('comments/toggle-show',[ArticleCommentController::class, 'toggleShowComment'])->name('comments.toggle-show');
        
        //umkm
        Route::resource('umkm', UmkmController::class);
        Route::post('umkmreview/toggle-show',[UmkmController::class, 'toggleShowUmkmReview'])->name('umkmreview.toggle-show');
        Route::get('/umkmreview/load-more', [UmkmController::class, 'loadMore'])->name('umkmreview.load-more');
        ///umkmreview
        Route::resource('umkmreview', UmkmReviewController::class);

        //apbd
        Route::resource('apbd', ApbdController::class);
    });
});


// // Error handling routes
// Route::fallback([ErrorController::class, 'notFound'])->name('error.404');

// // Custom error pages
// Route::get('/error/403', [ErrorController::class, 'forbidden'])->name('error.403');
// Route::get('/error/500', [ErrorController::class, 'internalError'])->name('error.500');

// // Add this at the end of the file
// if (app()->environment('production')) {
//     Route::any('{any}', [ErrorController::class, 'notFound'])->where('any', '.*');
// }