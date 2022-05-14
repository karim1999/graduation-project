<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::match(['get', 'post'], '/boxes', [BoxController::class, 'index'])->name('boxes.index');
    Route::match(['get', 'post'], '/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::match(['get', 'post'], '/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'index']);
});

require __DIR__.'/auth.php';
