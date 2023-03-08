<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductValidationController;
use App\Http\Controllers\RoyaltyProgramController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(ProductValidationController::class)->group(function () {
    Route::post('/rating/{id}', 'rating')->name('api.rating');
});
Route::controller(RoyaltyProgramController::class)->group(function () {
    Route::post('/claim/{id}', 'store')->name('api.claim.store');
});
Route::post('/report', [ProductValidationController::class, 'report'])->name('api.report');
