<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Owner\CashierController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Owner\TableController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Owner\OrderController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\User\RestaurantController;



Route::get('/', function () {
    return view('start');
})->name('start');


Route::middleware(['guest'])->group(function () {
    Route::get('/restaurant/{slug}/table/{table_number}/menu', [UserController::class, 'showMenu'])
        ->name('user.menu.show');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'is_owner'])->group(function () {
    Route::post('/restaurant/create', [RestaurantController::class, 'store'])
        ->name('restaurant.store');
    Route::prefix('/restaurant/{restaurant:slug}/dashboard')->group(function () {
        Route::get('/', [OwnerController::class, 'index'])
            ->name('owner.dashboard.home');
        Route::get('/category', [CategoryController::class, 'index'])
            ->name('owner.dashboard.category');
        Route::post('/category', [CategoryController::class, 'store'])
            ->name('owner.dashboard.category.store');
        Route::put('/category/{category}', [CategoryController::class, 'update'])
            ->name('owner.dashboard.category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])
            ->name('owner.dashboard.category.destroy');
        Route::get('/menu', [MenuController::class, 'index'])
            ->name('owner.dashboard.menu');
        Route::get('/tables', [TableController::class, 'index'])
            ->name('owner.dashboard.tables');
        Route::delete('/tables/{table}', [TableController::class, 'destroy'])
            ->name('owner.dashboard.tables.destroy');
        Route::post('/tables', [TableController::class, 'store'])
            ->name('owner.dashboard.tables.store');
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('owner.dashboard.orders');
        Route::get('/cashier', [CashierController::class, 'index'])
            ->name('owner.dashboard.cashier');
    });
});
