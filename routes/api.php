<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerServicePageController;
use App\Http\Controllers\WhereToPurchaseController;
use App\Http\Middleware\LocaleMiddleware;
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

Route::group(['prefix' => LocaleMiddleware::getLocale(), 'middleware' => LocaleMiddleware::class], function(){
    Route::get('/about', [AboutController::class, 'about']);
    Route::get('/where', [WhereToPurchaseController::class, 'where']);
    Route::get('/contact', [ContactController::class, 'contact']);
    Route::get('/customer_service', [CustomerServicePageController::class, 'custServ']);
    Route::get('/career', [CareerPageController::class, 'career']);
});
