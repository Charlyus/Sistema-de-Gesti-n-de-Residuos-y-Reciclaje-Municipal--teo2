<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\OperadorController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'showLogin']);
Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/dashboard', function(){
    return "Bienvenido al sistema";
});


Route::middleware(['role:Administrador'])->group(function(){

    Route::get('/admin/dashboard',[AdminController::class,'dashboard']);

});

Route::middleware(['role:Coordinador'])->group(function(){

    Route::get('/coordinador/dashboard',[CoordinadorController::class,'dashboard']);

});

Route::middleware(['role:Operador'])->group(function(){

    Route::get('/operador/dashboard',[OperadorController::class,'dashboard']);

});
