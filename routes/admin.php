<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDasboardController;
use App\Http\Controllers\Admin\AdminSettingWebController;
use App\Http\Controllers\Admin\AdminTyperQrcodeController;
use App\Http\Controllers\Admin\AdminCustomerDataController;
use App\Http\Controllers\Admin\AdminPartnerProdukController;
use App\Http\Controllers\Admin\AdminRequestQrcodeController;

Route::middleware(['auth:web'])->group(function () {
  Route::prefix('panel')->group(function () {
    Route::get('/', function () {
      return to_route('admin.dashboard');
    });
    Route::get('/dashboard', AdminDasboardController::class)->name('admin.dashboard');

    Route::controller(AdminPartnerController::class)->group(function () {
      Route::get('/partner', 'index')->name("admin.partner.index");
      Route::get('/partner/create', 'create')->name("admin.partner.create");
      Route::post('/partner/store', 'store')->name("admin.partner.store");
      Route::get('/partner/show/{id}', 'show')->name("admin.partner.show");
      Route::get('/partner/edit/{id}', 'edit')->name('admin.partner.edit');
      Route::patch('/partner/update/{id}', 'update')->name("admin.partner.update");
      Route::delete('/partner/destroy/{id}', 'destroy')->name("admin.partner.destroy");
      Route::get('/partner/list_bisnis/{id}', 'list')->name("admin.partner.list");
    });

    Route::controller(AdminPartnerProdukController::class)->group(function () {
      Route::get('/partner_product', 'index')->name("admin.partner.product.index");
      Route::get('/partner_product/show/{id}', 'show')->name("admin.partner.product.show");
    });

    Route::controller(AdminRequestQrcodeController::class)->group(function () {
      Route::get('/request_qrcode', 'index')->name('admin.request.index');
      Route::get('/request_qrcode/create', 'create')->name('admin.request.create');
      Route::post('/request_qrcode/store', 'store')->name('admin.request.store');
      Route::get('/request_qrcode/show/{id}', 'show')->name('admin.request.show');
      Route::get('/request_qrcode/edit/{id}', 'edit')->name('admin.request.edit');
      Route::patch('/request_qrcode/update/{id}', 'update')->name('admin.request.update');
      Route::delete('/request_qrcode/destroy/{id}', 'destroy')->name('admin.request.destroy');
      Route::post('/request_qrcode/generate', 'generateQR')->name('admin.request.generate');
      Route::post('/request_qrcode/upProgress', 'upProgress')->name('admin.request.upProgress');
      Route::post('/request_qrcode/upResi', 'upResi')->name('admin.request.upResi');
      Route::get('/request_qrcode/download/{filename}', 'download')->name('admin.request.download');
    });
    Route::get('/export/QrCode/{id}', [QrCodeController::class, 'export'])->name('admin.export.Qr');

    Route::controller(AdminCustomerDataController::class)->group(function () {
      Route::get('/customer_data', 'index')->name('admin.customer.index');
      Route::get('/customer_data/show/{id}', 'show')->name('admin.customer.show');
      Route::post('/customer_data/update/{id}', 'update')->name('admin.customer.update');
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
      Route::get('/users', 'index')->name('admin.users.index');
      Route::get('/users/create', 'create')->name('admin.users.create');
      Route::post('/users/store', 'store')->name('admin.users.store');
      Route::get('/users/edit/{id}', 'edit')->name('admin.users.edit');
      Route::patch('/users/update/{id}', 'update')->name('admin.users.update');
      Route::delete('/users/destroy/{id}', 'destroy')->name('admin.users.destroy');
    });

    Route::controller(AdminRoleController::class)->group(function () {
      Route::get('/roles', 'index')->name('admin.roles.index');
      Route::get('/roles/create', 'create')->name('admin.roles.create');
      Route::post('/roles/store', 'store')->name('admin.roles.store');
      Route::get('/roles/show/{id}', 'show')->name('admin.roles.show');
      Route::get('/roles/edit/{id}', 'edit')->name('admin.roles.edit');
      Route::patch('/roles/update/{id}', 'update')->name('admin.roles.update');
      Route::delete('/roles/destroy/{id}', 'destroy')->name('admin.roles.destroy');
    });

    Route::controller(AdminSettingWebController::class)->group(function () {
      Route::get('/setting_web', 'index')->name('admin.setting.index');
      Route::patch('/setting_web/update/{id}', 'update')->name('admin.setting.update');
    });
  });
});
