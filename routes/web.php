<?php

use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('text');
});
