<?php

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

Route::group(['as' => 'api.'], function () {
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
});


Route::group(['as' => 'api.', 'namespace' => '\App\Http\Controllers\Api', 'middleware' => 'auth:sanctum'], function () {
//    Route::apiResources('categories',    CategoryController::class);
//    Route::apiResource('products',    ProductController::class);
//    Route::apiResource('brands',    BrandController::class);
//    Route::apiResource('posts',    PostController::class);
//    Route::apiResource('payment-methods',PaymentMethodController::class);
    //        ->parameters(['category', 'category:slug']);

    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::apiResources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'brands' => BrandController::class,
        'posts' => PostController::class,
        'payment-methods' => PaymentMethodController::class,
        'orders' => OrderController::class,
    ]);

});