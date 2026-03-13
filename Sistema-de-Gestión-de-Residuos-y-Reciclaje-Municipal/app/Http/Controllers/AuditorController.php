<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditorController extends Controller
{

    public function dashboard(Request $request)
{

$inicio = $request->inicio;
$fin = $request->fin;
$zona = $request->zona;


/* TONELADAS POR PERIODO */

$toneladasPeriodo = DB::table('entregas_reciclaje')
->selectRaw('SUM(cantidad_kg)/1000 as toneladas');

if($inicio && $fin){
$toneladasPeriodo->whereBetween('fecha_hora',[$inicio,$fin]);
}

$toneladasPeriodo = $toneladasPeriodo->first();




/* MATERIAL RECICLADO */

$materiales = DB::table('entregas_reciclaje')
->join('tipos_material','entregas_reciclaje.id_tipo_material','=','tipos_material.id_tipo_material')
->select('tipos_material.nombre',DB::raw('SUM(cantidad_kg) as total_kg'))
->groupBy('tipos_material.nombre')
->get();


/* PUNTOS VERDES ACTIVOS */

$puntosActivos = DB::table('entregas_reciclaje')
->join('puntos_verdes','entregas_reciclaje.id_punto_verde','=','puntos_verdes.id_punto_verde')
->select('puntos_verdes.nombre',DB::raw('SUM(cantidad_kg) as total_kg'))
->groupBy('puntos_verdes.nombre')
->orderByDesc('total_kg')
->limit(5)
->get();


/* DENUNCIAS POR ESTADO */

$denuncias = DB::table('denuncias')
->join('estados_denuncia','denuncias.id_estado','=','estados_denuncia.id_estado_denuncia')
->select('estados_denuncia.nombre', DB::raw('COUNT(*) as total'))
->groupBy('estados_denuncia.nombre')
->get();


return view('auditor.dashboard',compact(
    'toneladasPeriodo',
    'inicio',
    'fin',
    'materiales',
    'puntosActivos',
    'denuncias'
    ));

}

}