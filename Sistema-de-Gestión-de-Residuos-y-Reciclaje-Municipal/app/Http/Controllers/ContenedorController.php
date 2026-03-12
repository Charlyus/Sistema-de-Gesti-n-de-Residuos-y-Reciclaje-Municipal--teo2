<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenedor;
use App\Models\PuntoVerde;
use App\Models\TipoMaterial;

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
'porcentaje_llenado'=>$request->porcentaje_llenado,
'ultima_limpieza'=>$request->ultima_limpieza

]);

return redirect('/contenedor/list');

}

public function list()
{

$contenedores = Contenedor::with(['puntoVerde','material'])->get();

return view('contenedor.list',compact('contenedores'));

}

}