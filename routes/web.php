<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('guest.index');
});
Route::get('/products', function () {
    return view('guest.product');
})->name('products');

Route::middleware('auth')->group(function () {

    // admin and superadmin routes group
    Route::middleware('checkRole:admin,superadmin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::controller(UserController::class)->name('admin.')->group(function () {
            Route::get('/admin/users', 'index')->name('users.index');
            Route::get('/admin/users/create', 'create')->name('users.create');
            Route::post('/admin/users', 'store')->name('users.store');
            Route::get('/admin/users/{user}/edit', 'edit')->name('users.edit');
            Route::put('/admin/users/{user}', 'update')->name('users.update');
            Route::delete('/admin/users/{user}', 'destroy')->name('users.destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
