<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenedor;
use App\Models\PuntoVerde;
use App\Models\TipoMaterial;
use App\Models\Usuario;
use App\Models\ProgramacionVaciado;

class ContenedorController extends Controller
{

public function create()
{

$puntos = PuntoVerde::all();
$materiales = TipoMaterial::all();

return view('contenedor.create',compact('puntos','materiales'));

}

public function store(Request $request)
{

Contenedor::create([

'id_punto_verde'=>$request->id_punto_verde,
'id_tipo_material'=>$request->id_tipo_material,
'capacidad_kg'=>$request->porcentaje_llenado

]);

return redirect('/contenedor/list');

}

public function list()
{

$contenedores = Contenedor::with(['puntoVerde','material'])->get();

return view('contenedor.list',compact('contenedores'));

}
public function solicitarVaciado()
{

$contenedores = Contenedor::all();

$recolectores = Usuario::where('id_rol',7)->get();

return view('contenedor.solicitar_vaciado',compact('contenedores','recolectores'));

}
public function programarVaciado(Request $request)
{

ProgramacionVaciado::create([

'id_contenedor'=>$request->id_contenedor,
'id_recolector'=>$request->id_recolector,
'fecha_programada'=>$request->fecha_programada,
'estado'=>'pendiente'

]);

return redirect('/punto-verde/dashboard');

}

}