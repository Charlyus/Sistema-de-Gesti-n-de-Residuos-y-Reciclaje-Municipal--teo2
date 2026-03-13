<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntregaReciclaje;
use App\Models\PuntoVerde;
use App\Models\TipoMaterial;
use App\Models\Usuario;
use App\Models\Contenedor;
use App\Models\NotificacionContenedor;

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
$porcentaje = ($contenedor->cantidad_actual_kg / $contenedor->capacidad_kg) * 100;
if($porcentaje >= 100){

    NotificacionContenedor::create([
    'id_contenedor'=>$contenedor->id_contenedor,
    'nivel'=>'lleno',
    'mensaje'=>'Contenedor lleno, requiere atención inmediata'
    ]);
    
    }
    
    elseif($porcentaje >= 90){
    
    NotificacionContenedor::create([
    'id_contenedor'=>$contenedor->id_contenedor,
    'nivel'=>'urgente',
    'mensaje'=>'Contenedor al 90%, programar vaciado urgente'
    ]);
    
    }
    
    elseif($porcentaje >= 75){
    
    NotificacionContenedor::create([
    'id_contenedor'=>$contenedor->id_contenedor,
    'nivel'=>'temprana',
    'mensaje'=>'Contenedor al 75%, alerta temprana'
    ]);
    
    }

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