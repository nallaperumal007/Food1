<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Addons\PaymentController;


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


Route::group(['middleware' =>'AuthMiddleware'],function(){

    Route::group(['middleware' =>'AdminMiddleware' , 'prefix' => 'admin'],function(){
        Route::get('/payments',[PaymentController::class,'index'])->name('payments');
        Route::post('/payments/edit/status',[PaymentController::class,'status']);
        Route::get('/payments/edit-{id}',[PaymentController::class,'show']);
        Route::post('/payments/update-{id}',[PaymentController::class,'update']);
    });

    Route::group(['middleware' =>'VendorMiddleware' , 'prefix' => 'vendor'],function(){
        Route::get('/payments',[PaymentController::class,'index'])->name('payments');
        Route::post('/payments/edit/status',[PaymentController::class,'status']);
        Route::get('/payments/edit-{id}',[PaymentController::class,'show']);
        Route::post('/payments/update-{id}',[PaymentController::class,'update']);
    });

});