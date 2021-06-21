<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CouponController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ProductImageController;
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
//login route
Route::post('login', [AuthController::class, 'login']);

//Public routes
Route::apiResource('product', ProductController::class)->only('index','show');
Route::apiResource('category', CategoryController::class)->only('index','show');
Route::apiResource('product-image', ProductImageController::class)->only('index','show');
Route::apiResource('coupon', CouponController::class)->only('index','show');

//Admin routes
Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('product', ProductController::class)->except('index','show');
        Route::apiResource('category', CategoryController::class)->except('index','show');
        Route::apiResource('product-image', ProductImageController::class)->except('index','show');
        Route::apiResource('coupon', CouponController::class)->except('index','show');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
