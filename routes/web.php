<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // admin and superadmin routes group
    Route::middleware('checkRole:admin,superadmin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/template/table', function () {
            return view('admin.component-template.table', [
                'columns' => ['ID', 'Nama Produk', 'Harga', 'Stok'],
                'data' => [
                    ['ID' => 1, 'Nama Produk' => 'Sepatu A', 'Harga' => '150.000', 'Stok' => 20],
                    ['ID' => 2, 'Nama Produk' => 'Sepatu B', 'Harga' => '200.000', 'Stok' => 15],
                ],
            ]);
        })->name('template.table');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
