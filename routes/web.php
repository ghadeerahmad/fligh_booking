<?php

use App\Http\Controllers\api\FlightController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PcrController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\UsersController;
use App\Models\Flight;
use App\Models\Store;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>['auth','admin']],function(){
    Route::get('/control',[UsersController::class,'index']);
    Route::get('/control/users',[UsersController::class,'index']);
    Route::get('/control/services',[ServicesController::class,'index']);
    Route::get('/control/services/{id}',[ServicesController::class,'services']);
    Route::get('/control/services/add/{id}',[ServicesController::class,'addServicePage']);
    Route::post('/control/services/add/{id}',[ServicesController::class,'addService']);
    Route::get('/control/services/update/{id}',[ServicesController::class,'updatePage']);
    Route::post('/control/services/update/{id}',[ServicesController::class,'update']);
    Route::delete('/control/services/delete/{id}',[ServicesController::class,'delete']);
    Route::get('/control/categories',[CategoriesController::class,'index']);
    Route::get('/control/addCategory',[CategoriesController::class,'addCategoryPage']);
    Route::post('/control/addCategory',[CategoriesController::class,'addCategory']);
    Route::get('/control/updateCategory/{id}',[CategoriesController::class,'updateCategoryPage']);
    Route::post('/control/updateCategory/{id}',[CategoriesController::class,'updateCategory']);
    Route::delete('/control/deleteCategory/{id}',[CategoriesController::class,'delete']);
    Route::get('/control/stores/{category}',[StoresController::class,'index']);
    Route::get('/control/addStore/{id}',[StoresController::class,'addStorePage']);
    Route::post('/control/addStore/{id}',[StoresController::class,'addStore']);
    Route::get('/control/updateStore/{id}',[StoresController::class,'updateStorePage']);
    Route::post('/control/updateStore/{id}',[StoresController::class,'updateStore']);
    Route::delete('/control/deleteStore/{id}',[StoresController::class,'delete']);
    Route::get('/control/stores',[StoresController::class,'allStores']);
    Route::get('/control/products',[ProductsController::class,'all']);
    Route::get('/control/serviceRequests',[ServicesController::class,'getRequests']);
    Route::get('/control/serviceRequests/{id}',[ServicesController::class,'requestDetails']);
    Route::get('/control/chats',[MessagesController::class,'index']);
    Route::get('/control/chat',[MessagesController::class,'chat']);
    Route::get('/control/getChat/{id}',[MessagesController::class,'getChat']);
    Route::post('/control/sendMessage/{id}',[MessagesController::class,'sendMessage']);
    Route::get('/control/chat/{id}',[MessagesController::class,'openChat']);
    Route::delete('/control/users/delete/{id}',[UsersController::class,'delete']);
    Route::get('/control/pcrs',[PcrController::class,'index']);
    Route::get('/control/car',[CarController::class,'index']);
    Route::get('/control/car/{id}',[CarController::class,'details']);
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/control/products/{store}',[ProductsController::class,'index']);
    Route::get('/control/addProduct/{store}',[ProductsController::class,'addProductPage']);
    Route::post('/control/addProduct/{id}',[ProductsController::class,'addProduct']);
    Route::get('/control/updateProduct/{id}',[ProductsController::class,'updateProductPage']);
    Route::post('/control/updateProduct/{id}',[ProductsController::class,'updateProduct']);
    Route::delete('/control/deleteProduct/{id}',[ProductsController::class,'delete']);
});
Route::group(['middleware'=>['guest']],function(){
    Route::get('login',[UsersController::class,'loginPage'])->name('login');
    Route::post('login',[UsersController::class,'login']);
    Route::get('register',[UsersController::class,'registerPage'])->name('register');
    Route::post('register',[UsersController::class,'register']);
});
Route::get('/logout',[UsersController::class,'logout']);
Route::get('/', function () {
    return view('welcome');
});