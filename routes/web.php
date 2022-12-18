<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCustomerDataController;
use App\Http\Controllers\Admin\AdminDasboardController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminPartnerProdukController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminRequestQrcodeController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminSettingWebController;
use App\Http\Controllers\Admin\AdminTyperQrcodeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Partner\PartnerBisnisController;
use App\Http\Controllers\Partner\PartnerCustomerDataController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerProductController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Partner\PartnerSosmedController;
use App\Http\Controllers\Partner\PartnerTypeQrcodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['isAktif'])->group(function () {
    Route::get('/', function () {
        return 'Halaman Home';
    });

    // backend parnter
    Route::prefix('partner')->group(function () {
        Route::get('/dashboard', PartnerDashboardController::class);

        Route::controller(PartnerBisnisController::class)->group(function () {
            Route::get('bisnis', 'index');
        });

        Route::controller(PartnerProductController::class)->group(function () {
            Route::get('/product', 'index');
        });

        Route::controller(PartnerTypeQrcodeController::class)->group(function () {
            Route::get('/type_qrcode', 'index');
        });

        Route::controller(PartnerProfileController::class)->group(function () {
            Route::get('/profile', 'index');
        });

        Route::controller(PartnerCustomerDataController::class)->group(function () {
            Route::get('/customer_data', 'index');
        });

        Route::controller(PartnerSosmedController::class)->group(function () {
            Route::get('/sosmed', 'index');
        });
    });

    // backend admin
    Route::prefix('panel')->group(function () {
        Route::get('/dashboard', AdminDasboardController::class);

        Route::controller(AdminPartnerController::class)->group(function () {
            Route::get('/partner', 'index');
            Route::get('/partner/create', 'create');
            Route::post('/partner/store', 'store');
            Route::get('/partner/show/{id}', 'show');
            Route::get('/partner/edit/{id}', 'edit');
            Route::patch('/partner/update/{id}', 'update');
            Route::delete('/partner/destroy/{id}', 'destroy');
            Route::get('/partner/list_bisnis/{id}', 'list');
        });

        Route::controller(AdminPartnerProdukController::class)->group(function () {
            Route::get('/partner_product', 'index');
            Route::get('/partner_product/show/{id}', 'show');
        });

        Route::controller(AdminRequestQrcodeController::class)->group(function () {
            Route::get('/request_qrcode', 'index');
            Route::get('/request_qrcode/show/{id}', 'show');
        });

        Route::controller(AdminCustomerDataController::class)->group(function () {
            Route::get('/customer_data', 'index');
            Route::get('/customer_data/show/{id}', 'show');
            Route::post('/customer_data/lock/{id}', 'lock');
        });

        Route::controller(AdminContactController::class)->group(function () {
            Route::get('/contact', 'index');
        });

        Route::controller(AdminReportController::class)->group(function () {
            Route::get('/report', 'index');
        });

        Route::controller(AdminCategoryController::class)->group(function () {
            Route::get('/category', 'index');
            Route::get('/category/create', 'create');
            Route::post('/category/store', 'store');
            Route::get('/category/show/{id}', 'show');
            Route::get('/category/edit/{id}', 'edit');
            Route::patch('/category/update/{id}', 'update');
            Route::delete('/category/destroy/{id}', 'detroy');
        });

        Route::controller(AdminTyperQrcodeController::class)->group(function () {
            Route::get('/type_qrcode', 'index');
            Route::get('/type_qrcode/create', 'create');
            Route::post('/type_qrcode/store', 'store');
            Route::get('/type_qrcode/show/{id}', 'show');
            Route::get('/type_qrcode/edit/{id}', 'edit');
            Route::patch('/type_qrcode/update/{id}', 'update');
            Route::delete('/type_qrcode/destroy/{id}', 'detroy');
        });

        Route::controller(AdminUserController::class)->group(function () {
            Route::get('/users', 'index');
            Route::get('/users/create', 'create');
            Route::post('/users/store', 'store');
            Route::get('/users/edit/{id}', 'edit');
            Route::patch('/users/update/{id}', 'update');
            Route::delete('/users/destroy/{id}', 'destroy');
        });

        Route::controller(AdminRoleController::class)->group(function () {
            Route::get('/roles', 'index');
            Route::get('/roles/create', 'create');
            Route::post('/roles/store', 'store');
            Route::get('/roles/show/{id}', 'show');
            Route::get('/roles/edit/{id}', 'edit');
            Route::patch('/roles/update/{id}', 'update');
            Route::delete('/roles/destroy/{id}', 'detroy');
        });

        Route::controller(AdminSettingWebController::class)->group(function () {
            Route::get('/setting_web', 'index');
            Route::patch('/setting_web/update/{id}', 'update');
        });
    });

    Route::get('/validation/check-product', function () {
        return Inertia::render('Frontend/ProductValidation/CheckProduct');
    });

    Route::get('/validation/result', function () {
        return Inertia::render('Frontend/ProductValidation/ValidationResult');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
