<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDasboardController;
use App\Http\Controllers\Admin\AdminSettingWebController;
use App\Http\Controllers\Partner\PartnerBisnisController;
use App\Http\Controllers\Partner\PartnerSosmedController;
use App\Http\Controllers\Admin\AdminTyperQrcodeController;
use App\Http\Controllers\Partner\PartnerProductController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Admin\AdminCustomerDataController;
use App\Http\Controllers\Admin\AdminPartnerProdukController;
use App\Http\Controllers\Admin\AdminRequestQrcodeController;
use App\Http\Controllers\Partner\PartnerAuthController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerTypeQrcodeController;
use App\Http\Controllers\Partner\PartnerCustomerDataController;
use App\Http\Controllers\Partner\PartnerRequestQrcodeController;
use App\Http\Controllers\QrCodeController;

Route::middleware(['isAktif'])->group(function () {
    Route::get('/', function () {
        return 'Halaman Home';
    })->name('home');
    Route::controller(PartnerAuthController::class)
        ->prefix('partner')
        ->as('partner.')
        ->group(function () {
            Route::get('/login', 'index')->name('login');
            Route::post('/auth', 'handleLogin')->name('auth');
            Route::post('/logout', 'logout')->name('logout');
        });
    // backend parnter
    Route::middleware(['auth:partners'])->group(function () {
        Route::prefix('partner')
            ->as('partner.')
            ->group(function () {
                Route::get('/dashboard', PartnerDashboardController::class)->name('dashboard');

                Route::controller(PartnerBisnisController::class)->group(function () {
                    Route::get('bisnis', 'index')->name('bisnis.index');
                });

                Route::controller(PartnerProductController::class)->group(function () {
                    Route::get('/produk', 'index')->name('produk.index');
                });

                Route::controller(PartnerRequestQrcodeController::class)->group(function () {
                    Route::get('/request_qrcode', 'index')->name('request.index');
                });

                Route::controller(PartnerCustomerDataController::class)->group(function () {
                    Route::get('/customer_data', 'index')->name('customer.index');
                });

                Route::controller(PartnerSosmedController::class)->group(function () {
                    Route::get('/links', 'index')->name('links.index');
                });


                Route::controller(PartnerProfileController::class)->group(function () {
                    Route::get('/profile', 'index')->name('profil.index');
                });
            });
    });
});
// backend admin
Route::middleware(['auth:web'])->group(function () {
    Route::prefix('panel')->group(function () {
        Route::get('/dashboard', AdminDasboardController::class);

        Route::controller(AdminPartnerController::class)->group(function () {
            Route::get('/partner', 'index')->name("admin.partner.index");
            Route::get('/partner/create', 'create')->name("admin.partner.create");
            Route::post('/partner/store', 'store')->name("admin.partner.store");
            Route::get('/partner/show/{id}', 'show')->name("admin.partner.show");
            Route::get('/partner/edit/{id}', 'edit')->name('admin.partner.edit');
            Route::patch('/partner/update/{id}', 'update')->name("admin.partner.update");
            Route::get('/partner/destroy/{id}', 'destroy')->name("admin.partner.destroy");
            Route::get('/partner/list_bisnis/{id}', 'list')->name("admin.partner.list");
        });

        Route::controller(AdminPartnerProdukController::class)->group(function () {
            Route::get('/partner_product', 'index')->name("admin.partner.product.index");
            Route::get('/partner_product/show/{id}', 'show')->name("admin.partner.product.show");
        });

        Route::controller(AdminRequestQrcodeController::class)->group(function () {
            Route::get('/request_qrcode', 'index')->name('admin.request.index');
            Route::get('/request_qrcode/show/{id}', 'show')->name('admin.request.show');
            Route::post('/request_qrcode/generate', 'generateQR')->name('admin.request.generate');
            Route::post('/request_qrcode/upProgress', 'upProgress')->name('admin.request.upProgress');
            Route::post('/request_qrcode/upResi', 'upResi')->name('admin.request.upResi');
        });
        Route::get('/export/QrCode/{id}', [QrCodeController::class, 'export'])->name('admin.export.Qr');

        Route::controller(AdminCustomerDataController::class)->group(function () {
            Route::get('/customer_data', 'index')->name('admin.customer.index');
            Route::get('/customer_data/show/{id}', 'show')->name('admin.customer.show');
            Route::post('/customer_data/lock/{id}', 'lock')->name('admin.customer.lock');
        });

        Route::controller(AdminContactController::class)->group(function () {
            Route::get('/contact', 'index')->name('admin.contact.index');
        });

        Route::controller(AdminReportController::class)->group(function () {
            Route::get('/report', 'index')->name('admin.report.index');
        });

        Route::controller(AdminCategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('admin.category.index');
            Route::get('/category/create', 'create')->name('admin.category.create');
            Route::post('/category/store', 'store')->name('admin.category.store');
            Route::get('/category/show/{id}', 'show')->name('admin.category.show');
            Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
            Route::patch('/category/update/{id}', 'update')->name('admin.category.update');
            Route::get('/category/destroy/{id}', 'destroy')->name('admin.category.destroy');
        });

        Route::controller(AdminTyperQrcodeController::class)->group(function () {
            Route::get('/type_qrcode', 'index')->name('admin.type.index');
            Route::get('/type_qrcode/create', 'create')->name('admin.type.create');
            Route::post('/type_qrcode/store', 'store')->name('admin.type.store');
            Route::get('/type_qrcode/show/{id}', 'show')->name('admin.type.show');
            Route::get('/type_qrcode/edit/{id}', 'edit')->name('admin.type.edit');
            Route::patch('/type_qrcode/update/{id}', 'update')->name('admin.type.update');
            Route::get('/type_qrcode/destroy/{id}', 'destroy')->name('admin.type.destroy');
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
            Route::get('/setting_web', 'index')->name('admin.setting.index');
            Route::patch('/setting_web/update/{id}', 'update')->name('admin.setting.update');
        });
    });
});

Route::get('/validation/check-product', function () {
    return Inertia::render('Frontend/ProductValidation/CheckProduct');
});

Route::get('/validation/result', function () {
    return Inertia::render('Frontend/ProductValidation/ValidationResult');
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
