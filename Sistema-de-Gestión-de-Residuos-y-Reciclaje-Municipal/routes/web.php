<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\RecoleccionController;



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
    Route::get('/recolecciones/create',[CoordinadorController::class,'programar']);
    Route::post('/recolecciones/guardar',[CoordinadorController::class,'guardarProgramacion']);
    Route::get('/rutas/create',[RutaController::class,'crearRuta']);
    Route::post('/rutas/guardar',[RutaController::class,'guardarRuta']);
    Route::get('/camiones/create',[CamionController::class,'crearCamion']);
    Route::post('/camiones/guardar',[CamionController::class,'guardarCamion']);
    Route::get('/recoleccion/mapa/{id}',[RecoleccionController::class,'verMapa']);
    

});

Route::middleware(['role:Operador'])->group(function(){

    Route::get('/operador/dashboard',[OperadorController::class,'dashboard']);

});
