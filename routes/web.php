<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LeadController as AdminLeadController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\ProfileController;
use App\Models\Lead;
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
    Route::get('/usermessages', [AdminLeadController::class, 'index'])->name('usermessages');
});


require __DIR__ . '/auth.php';
