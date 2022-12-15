<?php

use App\Http\Controllers\api\CarController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\ChatController;
use App\Http\Controllers\api\FlightController;
use App\Http\Controllers\api\PcrController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\ServicesController;
use App\Http\Controllers\api\StoresController;
use App\Http\Controllers\api\UsersController;
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
Route::get('airports_search/{keyword}',[FlightController::class,'searchAirport']);
Route::get('flight_search',[FlightController::class,'searchFlights']);
Route::get('categories',[CategoriesController::class,'index']);
Route::get('stores/{category}',[StoresController::class,'index']);
Route::get('products/{store}',[ProductsController::class,'index']);
Route::get('services/{id}',[ServicesController::class,'index']);
Route::post('login',[UsersController::class,'login']);
Route::post('register',[UsersController::class,'register']);
Route::middleware('auth:api')->group(function(){
    Route::post('service/reserve/{id}',[ServicesController::class,'reserve']);
    Route::get('profile',[UsersController::class,'profile']);
    Route::post('pcr/reserve',[PcrController::class,'create']);
    Route::post('sendMessage/{id}',[ChatController::class,'sendMessage']);
    Route::get('chat',[ChatController::class,'getMessages']);
    Route::post('updateProfile',[UsersController::class,'update']);
    Route::post('car/create',[CarController::class,'create']);
});

