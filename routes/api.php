<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\MainController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ClientController;

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

Route::middleware('auth:sanctum', 'changelang')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api-lang'], function () {
    Route::prefix('v1')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('forget-password', [AuthController::class, 'forgetPassword']);
        Route::post('set-code', [AuthController::class, 'setCode']);
        Route::post('reset-password', [AuthController::class, 'reset']);
        Route::get('cards',[MainController::class,'getCards']);
        Route::get('products', [MainController::class, 'productByCat']);
        Route::get('get-product', [MainController::class, 'getProduct']);
  Route::get('settings',[MainController::class,'setting']);
  Route::get('offers',[MainController::class,'offers']);
  Route::get('sliders', [MainController::class, 'sliders']);
  Route::get('categories',[MainController::class,'categories']);
  Route::get('gover',[CartController::class,'governerate']);
  Route::group(['middleware' => 'auth:api'], function () {

    Route::post('create-cart',[CartController::class,'createCart']);
    Route::get('create-details',[CartController::class,'cartDetails']);
  Route::post('create-order',[OrderController::class,'checkout']);
  Route::post('make-review',[ClientController::class,'Review']);
});
      
    });
});
