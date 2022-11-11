<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::get('/products-on-stock', [ProductController::class, 'listOnStockProducts']);
Route::get('/products-by-category/{category_id}', [ProductController::class, 'productByCategory']);
Route::apiResource('orders', OrderController::class);
Route::apiResource('cards', CardController::class);
Route::get('/card_by_user/{user_id}', [CardController::class, 'cardByUser']);
Route::post('/products-search', [ProductController::class, 'searchProduct']);
