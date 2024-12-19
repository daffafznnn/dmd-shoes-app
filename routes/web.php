<?php

use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/test', function () {
            return App::getLocale();
        });

        // Route::get('/', [HomeController::class, 'index'])->name('home');
        // Route::resource('/products', ProductUserController::class)->except('edit');
        // Route::get('/products_detail/{slug}', [ProductUserController::class, 'detail'])->name('products.detail');
    }
);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
