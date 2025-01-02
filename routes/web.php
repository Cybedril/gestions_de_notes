<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ECController;
use App\Http\Controllers\UEController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('ues', UEController::class);
Route::resource('ecs', ECController::class);


