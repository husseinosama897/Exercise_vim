<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\reportController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',[ApiAuthController::class,'login']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum']],function(){


    Route::post('/logout',[ApiAuthController::class,'logout']);

    
    Route::get('transaction/list', [TransactionController::class ,'list']);

    
    Route::group(['middleware'=>['admin']],function(){

        
    Route::post('transaction/store', [TransactionController::class ,'store']);

  
        Route::post('payment/store', [paymentController::class ,'store']);


    Route::post('report/transaction', [reportController::class ,'transaction']);


});

   
   


});




