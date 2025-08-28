<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthCashierController;

Route::post('/cashier/login', [AuthCashierController::class, 'login'])
    ->name('api.cashier.login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
