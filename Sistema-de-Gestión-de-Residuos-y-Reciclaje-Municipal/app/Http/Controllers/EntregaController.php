<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntregaReciclaje;
use App\Models\PuntoVerde;
use App\Models\TipoMaterial;
use App\Models\Usuario;
use App\Models\Contenedor;

class EntregaController extends Controller
{

public function create()
{

$puntos = PuntoVerde::all();
$materiales = TipoMaterial::all();
$ciudadanos = Usuario::where('id_rol',4)->get();

return view('entrega.create',compact('puntos','materiales','ciudadanos'));

}

public function store(Request $request)
{

$contenedor = Contenedor::find($request->id_contenedor);

if(!$contenedor){
return back()->with('error','Contenedor no encontrado');
}

$capacidad = $contenedor->capacidad_kg;
$actual = $contenedor->cantidad_actual_kg;
$nuevo_total = $actual + $request->cantidad_kg;

if($nuevo_total > $capacidad){
return back()->with('error','El contenedor no tiene suficiente capacidad disponible');
}

EntregaReciclaje::create([

'id_punto_verde'=>$request->id_punto_verde,
'id_usuario'=>$request->id_usuario ?: null,
'id_tipo_material'=>$request->id_tipo_material,
'cantidad_kg'=>$request->cantidad_kg

]);

$contenedor->cantidad_actual_kg = $nuevo_total;

$contenedor->save();

return redirect('/entrega/list')->with('success','Entrega registrada');

}

public function list()
{

$entregas = EntregaReciclaje::with(['puntoVerde','material','usuario'])->get();

return view('entrega.list',compact('entregas'));

}
public function contenedoresDisponibles(Request $request)
{

$contenedores = Contenedor::where('id_punto_verde',$request->id_punto_verde)
->where('id_tipo_material',$request->id_tipo_material)
->get();

$contenedores = $contenedores->map(function($c){

$porcentaje = ($c->cantidad_actual_kg / $c->capacidad_kg) * 100;

$c->porcentaje = round($porcentaje,2);

return $c;

});

return response()->json($contenedores);

}

}