<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerPageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerServicePageController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\MakeRequestPageModelController;
use App\Http\Controllers\OneItemModelController;
use App\Http\Controllers\OnlineAppointmentController;
use App\Http\Controllers\PopupsController;
use App\Http\Controllers\PrivateAppointmentController;
use App\Http\Controllers\ThankForRequestController;
use App\Http\Controllers\TrunkShowController;
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

    //category page
    Route::get('/categories', [CategoryController::class, 'getCategoryList']);
    Route::get('/categories/{slug}', [CategoryController::class, 'getOneCategory']);

    //products
    Route::get('/products', [OneItemModelController::class, 'getProductList']);
//    Route::get('/products/category/{slug}', [OneItemModelController::class, 'getProductList']);
    Route::get('/products/available', [OneItemModelController::class, 'getProductListAvailable']);
    Route::get('/products/{slug}', [OneItemModelController::class, 'getOneProduct']);

    //popups get
    Route::get('/popup/make_request', [MakeRequestPageModelController::class, 'index']);
    Route::get('/popup/event_registration', [EventRegistrationController::class, 'index']);
    Route::get('/popup/online_appointment', [OnlineAppointmentController::class, 'index']);
    Route::get('/popup/private_appointment', [PrivateAppointmentController::class, 'index']);
    Route::get('/popup/thank_for_request', [ThankForRequestController::class, 'index']);
    Route::get('/popup/trunk_show', [TrunkShowController::class, 'index']);

    //popups post
    Route::post('/popup/make_request', [PopupsController::class, 'makeRequestPopupSend']);
    Route::post('/popup/event_registration', [PopupsController::class, 'eventRegistrationPopupSend']
    );
    Route::post('/popup/online_appointment', [PopupsController::class, 'onlineAppointmentPopupSend']);
    Route::post('/popup/private_appointment', [PopupsController::class, 'privatAppointmentPopupSend']);
    Route::post('/popup/trunk_show', [PopupsController::class, 'trunkShowPopupSend']);



});
