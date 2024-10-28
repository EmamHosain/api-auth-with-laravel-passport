<?php
use App\Http\Controllers\Api\Customer\CustomerAuthController;
use Illuminate\Support\Facades\Route;


Route::controller(CustomerAuthController::class)->group(function () {
    Route::get('/login', 'customerLogin');
    Route::get('/register', 'customerRegister');
});


Route::controller(CustomerAuthController::class)->middleware(['auth:api','customer:check-customer'])->group(function () {
    Route::get('/profile', 'getCustomerProfile');
    Route::get('/logout', 'customerLogout');
});