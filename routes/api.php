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

// TODO , 'middleware'=> 'auth:sanctum'  разобратся
Route::group(['as' => 'api.','namespace' => '\App\Http\Controllers\Api'], function () {
    Route::apiResource('categories',    CategoryController::class);
    Route::apiResource('products',    ProductController::class);
    Route::apiResource('brands',    BrandController::class);
    Route::apiResource('posts',    PostController::class);

//        ->parameters(['category', 'category:slug']);
});