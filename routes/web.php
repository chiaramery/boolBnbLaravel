<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::put('/apartments/{apartmentSlug}', [ApartmentController::class, 'update'])
    ->name('apartments.update')
    ->middleware(['auth', 'check.apartment.owner']);

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);
    Route::get('/search', [ApartmentController::class, 'search'])->name('search');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/promotions', [OrderController::class, 'index'])->name('promotions.index');
    Route::post('/orders/make-payment', [OrderController::class, 'store'])->name('orders.makePayment');
});


require __DIR__ . '/auth.php';
