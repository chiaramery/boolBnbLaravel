<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Promotions\PromotionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('leads', [LeadController::class, 'store']);
Route::get('/all', [ApartmentController::class, 'all']);
Route::get('filter', [ApartmentController::class, 'filter']);
Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('orders/generate', [OrderController::class, 'generate']);
Route::post('orders/make/payement', [OrderController::class, 'makePayement']);
Route::get('promotions', [PromotionsController::class, 'index']);
