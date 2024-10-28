<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Merchant\MerchantAuthController;


Route::controller(MerchantAuthController::class)->group(function () {
    Route::post('/login', 'merchantLogin');
    Route::post('/register', 'merchantRegister');
});


Route::controller(MerchantAuthController::class)->middleware(['auth:api', 'merchant:check-merchant'])->group(function () {
    Route::get('/profile', 'getMerchantProfile');
    Route::get('/logout', 'merchantLogout');
    Route::get('/get-token', 'getTokenWithScopes');
});