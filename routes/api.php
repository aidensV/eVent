<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UsersController;
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
Route::post('login',[UsersController::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('list-lab',[LabController::class,'listLab']);
    Route::get('list-module',[ModuleController::class,'listModule']);
    Route::post('store-history',[HistoryController::class,'store']);
    Route::get('get-module-by-id/{id}',[ModuleController::class,'getModuleById']);
    Route::get('get-history-by-admin',[HistoryController::class,'getHistory']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
