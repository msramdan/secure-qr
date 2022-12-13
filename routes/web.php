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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Partner\PartnerBisnisController;
use App\Http\Controllers\Partner\PartnerCustomerDataController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerProductController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Partner\PartnerSosmedController;
use App\Http\Controllers\Partner\PartnerTypeQrcodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidationController;
use App\Http\Middleware\isActive;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['isActive'])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/privacy-policy', 'policy');
        Route::get('/disclaimer', 'disclaimer');
        Route::get('/sitemap.xml', 'sitemap');
        Route::post('/contact', 'contact');
    });
    Route::controller(ValidationController::class)->group(function () {
        Route::get('/scan/{id}', 'scan');
        Route::post('/cek_produk', 'cek_produk');
        Route::post('/report', 'report');
        Route::post('/rating', 'rating');
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

        // belum selesai
        Route::controller(AdminPartnerController::class)->group(function () {
            Route::get('/partner', 'index');
        });

        Route::controller(AdminPartnerProdukController::class)->group(function () {
            Route::get('/partner_product', 'index');
            Route::get('/partner_product/show/{id}', 'show');
        });

        Route::controller(AdminRequestQrcodeController::class)->group(function () {
            Route::get('/request_qrocde', 'index');
        });

        Route::controller(AdminCustomerDataController::class)->group(function () {
            Route::get('/customer_data', 'index');
        });

        Route::controller(AdminContactController::class)->group(function () {
            Route::get('/contact', 'index');
        });

        Route::controller(AdminReportController::class)->group(function () {
            Route::get('/report', 'index');
        });

        Route::controller(AdminCategoryController::class)->group(function () {
            Route::get('/catgory', 'index');
        });

        Route::controller(AdminTyperQrcodeController::class)->group(function () {
            Route::get('/type_qrcode', 'index');
        });

        Route::controller(AdminUserController::class)->group(function () {
            Route::get('/user', 'index');
        });

        Route::controller(AdminRoleController::class)->group(function () {
            Route::get('/role', 'index');
        });

        Route::controller(AdminSettingWebController::class)->group(function () {
            Route::get('/setting_web', 'index');
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
});
