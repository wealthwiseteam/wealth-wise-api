<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//public routes
Route::post('register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//protected routes
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/budget/all',[BudgetController::class,'index']);
    Route::get('/budget/show/{id}',[BudgetController::class,'show']);
    Route::post('/budget/add',[BudgetController::class,'store']);
    Route::post('/budget/update/{id}',[BudgetController::class,'update']);
    Route::post('/budget/delete/{id}',[BudgetController::class,'destroy']);

    Route::get('/plan/all',[PlanController::class,'index']);
    Route::get('/plan/show/{id}',[PlanController::class,'show']);
    Route::post('/plan/add',[PlanController::class,'store']);
    Route::post('/plan/update/{id}',[PlanController::class,'update']);
    Route::post('/plan/delete/{id}',[PlanController::class,'destroy']);


    Route::get('/bill/all',[BillController::class,'index']);
    Route::get('/bill/show/{id}',[BillController::class,'show']);
    Route::post('/bill/add',[BillController::class,'store']);
    Route::post('/bill/update/{id}',[BillController::class,'update']);
    Route::post('/bill/delete/{id}',[BillController::class,'destroy']);

    Route::get('/account/all',[AccountController::class,'index']);
    Route::get('/account/show/{id}',[AccountController::class,'show']);
    Route::post('/account/add',[AccountController::class,'store']);
    Route::post('/account/update/{id}',[AccountController::class,'update']);
    Route::post('/account/delete/{id}',[AccountController::class,'destroy']);

    //Routes for transactions not complete

    Route::get('tip/all',[TipController::class,'index']);
    Route::get('tip/show/{id}',[TipController::class,'show']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

});
