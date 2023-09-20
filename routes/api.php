<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\ItemController;
use App\Http\Controllers\Api\Frontend\ApiController;
use App\Http\Controllers\Api\Backend\AdminController;
use App\Http\Controllers\Api\Backend\LoginController;
use App\Http\Controllers\Api\Backend\OfferController;
use App\Http\Controllers\Api\Backend\CategoryController;
use App\Http\Controllers\Api\Backend\FeedbackController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('admin/login',[LoginController::class, 'login_admin']);
Route::post('restaurant/login',[LoginController::class, 'login_restaurant']);

Route::group(['middleware'=>'localization'],function(){
Route::get('categories',[ApiController::class, 'categories']);
Route::get('offers',[ApiController::class, 'offers']);
Route::post('items',[ApiController::class, 'items']);
Route::post('store_feedback',[ApiController::class,'store_feedback']);
Route::post('search',[ApiController::class,'search']);
Route::get('get/item/{id}',[ApiController::class, 'getItem']);

});


Route::group(['middleware'=>['auth:sanctum','LocalizationAdmin'],'prefix'=>'admin'],function(){
Route::post('logout',[LoginController::class, 'logout']);
Route::apiResource('/admins',AdminController::class)->except('update');
Route::post('/admins/{id}',[AdminController::class,'update']);
Route::get('/getSubscriptions',[AdminController::class, 'getSubscriptions']);
Route::get('/getThemes',[AdminController::class, 'getThemes']);
Route::apiResource('/categories',CategoryController::class)->except('update');
Route::post('/categories/{id}',[CategoryController::class,'update']);
Route::apiResource('/items',ItemController::class)->except('update');
Route::post('/items/{id}',[ItemController::class,'update']);
Route::apiResource('/offers',OfferController::class)->except('update');
Route::post('/offers/{id}',[OfferController::class,'update']);
Route::get('/feedback',[FeedbackController::class, 'index']);
});
