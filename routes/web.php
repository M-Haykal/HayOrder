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


Route::get('/restaurant/{restaurant:slug}/table/{table}/menu', [UserController::class, 'showMenu'])
    ->name('user.menu.show');
Route::post('/restaurant/{restaurant:slug}/table/{table}/order', [UserController::class, 'store'])
    ->name('user.menu.store');
Route::middleware(['guest'])->group(function () {
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

        // Category Routes
        Route::get('/category', [CategoryController::class, 'index'])
            ->name('owner.dashboard.category');
        Route::post('/category', [CategoryController::class, 'store'])
            ->name('owner.dashboard.category.store');
        Route::put('/category/{category}', [CategoryController::class, 'update'])
            ->name('owner.dashboard.category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])
            ->name('owner.dashboard.category.destroy');

        // Menu Routes
        Route::get('/menu', [MenuController::class, 'index'])
            ->name('owner.dashboard.menu');
        Route::post('/menu', [MenuController::class, 'store'])
            ->name('owner.dashboard.menu.store');
        Route::put('/menu/{menu}', [MenuController::class, 'update'])
            ->name('owner.dashboard.menu.update');
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])
            ->name('owner.dashboard.menu.destroy');

        // Table Routes
        Route::get('/tables', [TableController::class, 'index'])
            ->name('owner.dashboard.tables');
        Route::delete('/tables/{table}', [TableController::class, 'destroy'])
            ->name('owner.dashboard.tables.destroy');
        Route::post('/tables', [TableController::class, 'store'])
            ->name('owner.dashboard.tables.store');

        // Order Routes
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('owner.dashboard.orders');

        // Cashier Routes
        Route::get('/cashier', [CashierController::class, 'index'])
            ->name('owner.dashboard.cashier');
        Route::post('/cashier', [CashierController::class, 'store'])
            ->name('owner.dashboard.cashier.store');
        Route::put('/cashier/{cashier}', [CashierController::class, 'update'])
            ->name('owner.dashboard.cashier.update');
        Route::delete('/cashier/{cashier}', [CashierController::class, 'destroy'])
            ->name('owner.dashboard.cashier.destroy');
            
        // Owner Document Restaurant Routes
        Route::get('/documents', [OwnerController::class, 'documents'])
            ->name('owner.dashboard.documents');
        Route::post('/documents', [OwnerController::class, 'storeDocument'])
            ->name('owner.dashboard.documents.store');
        Route::put('/documents/{document}', [OwnerController::class, 'updateDocuments'])
            ->name('owner.dashboard.documents.update');
        Route::delete('/documents/{document}', [OwnerController::class, 'destroyDocuments'])
            ->name('owner.dashboard.documents.destroy');
    });
});
