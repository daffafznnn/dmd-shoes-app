<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\MaterialController;
use App\Http\Controllers\Master\SizeController;
use App\Http\Controllers\Master\ColorController;
use App\Http\Controllers\Master\BannerController;
use App\Http\Controllers\Settings\GeneralController;
use App\Http\Controllers\Settings\PaymentMethodController;
use App\Http\Controllers\Settings\ShippingMethodController;
use App\Http\Controllers\Settings\SocialController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\App;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/test', function () {
            return App::getLocale();
        });

        Route::middleware('guest')->controller(GuestController::class)->group(function () {
            Route::get('/', 'index')->name('guest.index');
            Route::get('/product/detail/{slug}', 'viewDetail')->name('product.detail');
        });
    }
);


Route::middleware('auth')->group(function   () {

    // admin and superadmin routes group
    Route::middleware('checkRole:admin,superadmin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Product routes
        Route::controller(ProductController::class)->name('master.products.')->prefix('admin/master/products')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{slug}', 'show')->name('show');
            Route::post('/', 'store')->name('store');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::delete('/images/{id}', 'destroyImage')->name('destroyImage');
        });

        // Material routes
        Route::controller(MaterialController::class)->name('master.materials.')->prefix('admin/master/materials')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/{id}', 'show')->name('show');
        });

        // Category routes
        Route::controller(CategoryController::class)->name('master.categories.')->prefix('admin/master/categories')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Unit routes
        Route::controller(UnitController::class)->name('master.units.')->prefix('admin/master/units')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Size routes
        Route::controller(SizeController::class)->name('master.sizes.')->prefix('admin/master/sizes')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Color routes
        Route::controller(ColorController::class)->name('master.colors.')->prefix('admin/master/colors')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Banner routes
        Route::controller(BannerController::class)->name('master.banners.')->prefix('admin/master/banners')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/{slug}', 'show')->name('show');
        });

        Route::controller(UserController::class)->name('admin.')->prefix('admin/users')->group(function () {
            Route::get('/', 'index')->name('users.index');
            Route::get('/create', 'create')->name('users.create');
            Route::post('/', 'store')->name('users.store');
            Route::get('/{user}/edit', 'edit')->name('users.edit');
            Route::put('/{user}', 'update')->name('users.update');
            Route::delete('/{user}', 'destroy')->name('users.destroy');
        });
    });

    Route::middleware('checkRole:superadmin')->group(function () {
        Route::controller(GeneralController::class)->name('admin.settings.')->prefix('admin/settings/general')->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
        });

        // Payment method routes
        Route::controller(PaymentMethodController::class)->name('admin.payment-methods.')->prefix('admin/settings/payment-methods')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Shipping method routes
        Route::controller(ShippingMethodController::class)->name('admin.shipping-methods.')->prefix('admin/settings/shipping-methods')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Social media routes
        Route::controller(SocialController::class)->name('admin.socials.')->prefix('admin/settings/socials')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
