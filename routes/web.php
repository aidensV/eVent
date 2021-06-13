<?php

use App\Http\Controllers\LabController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('home');
});
Route::prefix('master')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/',[UsersController::class,'index'])->name('master.users');
        Route::get('/create',[UsersController::class,'create'])->name('master.users.add');
        Route::post('/',[UsersController::class,'store'])->name('master.users.store');
        Route::delete('/{id}',[UsersController::class,'delete'])->name('master.users.delete');
    });
    Route::prefix('prodi')->group(function(){
        Route::get('/',[ProdiController::class,'index'])->name('master.prodi');
        Route::post('/',[ProdiController::class,'store'])->name('master.prodi.store');
    });

    Route::prefix('lab')->group(function(){
        Route::get('/',[LabController::class,'index'])->name('master.lab');
        Route::get('/{id}/show',[LabController::class,'show'])->name('master.lab.show');
        Route::post('/',[LabController::class,'store'])->name('master.lab.store');
    });

    Route::prefix('module')->group(function(){
        Route::get('/',[ModuleController::class,'index'])->name('master.module');
        Route::get('/{id}/show',[ModuleController::class,'show'])->name('master.module.show');
        Route::get('/{id}/create',[ModuleController::class,'create'])->name('master.module.create');
        Route::post('/',[ModuleController::class,'store'])->name('master.module.store');
    });

});
