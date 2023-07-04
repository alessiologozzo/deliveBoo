<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DishController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);
    Route::resource('dishes', DishController::class)->parameters(['dishes' => 'dish:slug']);
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::resource('users', UserController::class)->parameters(['users' => 'user:id']);
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
