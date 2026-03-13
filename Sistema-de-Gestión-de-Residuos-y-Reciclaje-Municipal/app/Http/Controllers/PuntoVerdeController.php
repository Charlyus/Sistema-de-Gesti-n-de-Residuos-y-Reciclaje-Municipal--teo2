<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoVerde;
use App\Models\Usuario;
use App\Models\NotificacionContenedor;

class PuntoVerdeController extends Controller
{

public function dashboard()
{

$notificaciones = NotificacionContenedor::where('leida',false)
->orderBy('fecha','desc')
->get();

return view('punto_verde.dashboard',compact('notificaciones'));

}

public function create()
{
    
$empleados = Usuario::where('id_rol',7)->get();
    
return view('punto_verde.create',compact('empleados'));
    
}

public function store(Request $request)
{

PuntoVerde::create([

'nombre'=>$request->nombre,
'direccion'=>$request->direccion,
'latitud'=>$request->latitud,
'longitud'=>$request->longitud,
'capacidad_total_m3'=>$request->capacidad_total_m3,
'horario_atencion'=>$request->horario_atencion,
'encargado_id'=>$request->encargado_id

]);

return redirect('/punto-verde/dashboard');

}

public function list()
{

$puntos = PuntoVerde::all();

return view('punto_verde.list',compact('puntos'));

}

}