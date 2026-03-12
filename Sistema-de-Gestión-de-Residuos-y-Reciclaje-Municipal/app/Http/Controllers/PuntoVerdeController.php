<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoVerde;
use App\Models\Usuario;

class PuntoVerdeController extends Controller
{

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

}