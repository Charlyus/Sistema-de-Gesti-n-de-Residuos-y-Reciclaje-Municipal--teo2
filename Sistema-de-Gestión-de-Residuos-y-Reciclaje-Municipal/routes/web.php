<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\RecoleccionController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PuntoVerdeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ContenedorController;
use App\Http\Controllers\EntregaController;



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
    Route::get('/recoleccion/mapa/{id}', [RecoleccionController::class,'verMapa']);

Route::get('/recoleccion/iniciar/{id}', [RecoleccionController::class,'iniciar']);

Route::get('/recoleccion/finalizar/{id}', [RecoleccionController::class,'finalizarVista']);

Route::post('/recoleccion/finalizar', [RecoleccionController::class,'finalizar']);
Route::get('/zona/create', [ZonaController::class,'create']);

Route::post('/zona/store', [ZonaController::class,'store']);
    

});

    Route::middleware(['role:Operador'])->group(function(){

        Route::get('/punto-verde/dashboard',[PuntoVerdeController::class,'dashboard']);
            
            Route::get('/punto-verde/create',[PuntoVerdeController::class,'create']);
            
            Route::post('/punto-verde/store',[PuntoVerdeController::class,'store']);
            Route::get('/punto-verde/list',[PuntoVerdeController::class,'list']);

    Route::get('/material/create',[MaterialController::class,'create']);
    Route::post('/material/store',[MaterialController::class,'store']);
    Route::get('/material/list',[MaterialController::class,'list']);
    Route::get('/contenedor/create',[ContenedorController::class,'create']);
    Route::post('/contenedor/store',[ContenedorController::class,'store']);
    Route::get('/contenedor/list',[ContenedorController::class,'list']);
    Route::get('/entrega/create',[EntregaController::class,'create']);
    Route::post('/entrega/store',[EntregaController::class,'store']);
    Route::get('/entrega/list',[EntregaController::class,'list']);
    Route::get('/contenedores-disponibles',[EntregaController::class,'contenedoresDisponibles']);
    Route::get('/contenedor/solicitar-vaciado',[ContenedorController::class,'solicitarVaciado']);
Route::post('/contenedor/programar-vaciado',[ContenedorController::class,'programarVaciado']);

    });
