<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Partner\PartnerAuthController;
use App\Http\Controllers\Partner\PartnerBisnisController;
use App\Http\Controllers\Partner\PartnerSosmedController;
use App\Http\Controllers\Partner\PartnerProductController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerCustomerDataController;
use App\Http\Controllers\Partner\PartnerLoyaltyController;
use App\Http\Controllers\Partner\PartnerRatingController;
use App\Http\Controllers\Partner\PartnerRequestQrcodeController;

Route::controller(PartnerAuthController::class)
  ->prefix('partner')
  ->as('partner.')
  ->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register/store', 'handleRegister')->name('register.store');
    Route::get('/login', 'index')->name('login');
    Route::post('/auth', 'handleLogin')->name('auth');
    Route::post('/logout', 'logout')->name('logout');
  });
Route::middleware(['auth:partners'])->group(function () {
  Route::prefix('partner')
    ->as('partner.')
    ->group(function () {
      Route::get('/', function () {
        return to_route('partner.dashboard');
      });
      Route::get('/dashboard', PartnerDashboardController::class)->name('dashboard');

      Route::controller(PartnerBisnisController::class)->group(function () {
        Route::get('bisnis', 'index')->name('bisnis.index');
        Route::get('bisnis/create', 'create')->name('bisnis.create');
        Route::post('bisnis/store', 'store')->name('bisnis.store');
        Route::get('bisnis/show/{business:code}', 'show')->name('bisnis.show');
        Route::get('bisnis/edit/{business:code}', 'edit')->name('bisnis.edit');
        Route::patch('bisnis/update/{business:code}', 'update')->name('bisnis.update');
        Route::delete('bisnis/destroy/{business:code}', 'destroy')->name('bisnis.destroy');
      });

      Route::controller(PartnerProductController::class)->group(function () {
        Route::get('/produk', 'index')->name('produk.index');
        Route::get('/produk/create', 'create')->name('produk.create');
        Route::post('/produk/store', 'store')->name('produk.store');
        Route::get('/produk/show/{product:code}', 'show')->name('produk.show');
        Route::get('/produk/edit/{product:code}', 'edit')->name('produk.edit');
        Route::patch('/produk/update/{product:code}', 'update')->name('produk.update');
        Route::delete('/produk/destroy/{product:code}', 'destroy')->name('produk.destroy');
      });

      Route::controller(PartnerRatingController::class)->group(function () {
        Route::get('/produk/rating', 'index')->name('rating.index');
      });

      // Route::controller(PartnerLoyaltyController::class)->group(function () {
      //   Route::get('/loyalty', 'index')->name('loyalty.index');
      // });

      Route::controller(PartnerRequestQrcodeController::class)->group(function () {
        Route::get('/request_qrcode', 'index')->name('request.index');
        Route::get('/request_qrcode/show/{requestQr:code}', 'show')->name('request.show');
        Route::get('/request_qrcode/download/{filename}', 'download')->name('request.download');
        Route::post('/request_qrcode/upload/{id}', 'upload')->name('request.upload');
      });
      Route::get('/export/QrCode/{id}', [QrCodeController::class, 'export'])->name('export.Qr');

      Route::controller(PartnerCustomerDataController::class)->group(function () {
        Route::get('/customer_data', 'index')->name('customer.index');
        Route::get('/customer_data/show/{id}', 'show')->name('customer.show');
        Route::post('/customer_data/update/{id}', 'update')->name('customer.update');
      });

      Route::controller(PartnerSosmedController::class)->group(function () {
        Route::get('/links', 'index')->name('links.index');
        Route::get('/links/create', 'create')->name('links.create');
        Route::post('/links/store', 'store')->name('links.store');
        Route::get('/links/edit/{id}', 'edit')->name('links.edit');
        Route::patch('/links/update/{id}', 'update')->name('links.update');
        Route::delete('/links/destroy/{id}', 'destroy')->name('links.destroy');
      });


      Route::controller(PartnerProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profil.index');
        Route::patch('/profile/update/{id}','update')->name('profil.update');
      });
    });
});
