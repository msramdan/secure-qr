<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductValidationController;
use App\Http\Controllers\HomeController;

Route::middleware(['isAktif'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // product validation
    Route::controller(ProductValidationController::class)->group(function () {
        Route::get('/scan/{id}', 'scan')->name('scan');
        Route::any('/validation', 'validation')->name('validation');
        Route::post('/rating/{id}', 'rating')->name('rating');
        Route::post('/report', 'report')->name('report');
    });
    // backend parnter
    require __DIR__ . '/partner.php';
});
// backend admin
require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
