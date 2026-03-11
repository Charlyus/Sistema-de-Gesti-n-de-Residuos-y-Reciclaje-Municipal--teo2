<?php

namespace App\Http\Controllers;

use App\Models\Recoleccion;
use App\Models\PuntoRecoleccion;
use Illuminate\Http\Request;

class RecoleccionController extends Controller
{

    public function verMapa($id)
    {

        $recoleccion = Recoleccion::with('ruta')->findOrFail($id);

        $puntos = PuntoRecoleccion::where('id_recoleccion',$id)->get();

        return view('coordinador.mapa_recoleccion',compact('recoleccion','puntos'));

    }
    public function iniciar($id)
{
    $recoleccion = Recoleccion::findOrFail($id);

    $recoleccion->estado = "En proceso";
    $recoleccion->hora_inicio_real = now();

    $recoleccion->save();

    return redirect()->back();
}
public function finalizarVista($id)
{
    $recoleccion = Recoleccion::findOrFail($id);

    return view('coordinador.finalizar_recoleccion',compact('recoleccion'));
}
public function finalizar(Request $request)
{

$recoleccion = Recoleccion::findOrFail($request->id_recoleccion);

$puntos = PuntoRecoleccion::where('id_recoleccion',$recoleccion->id_recoleccion)
->where('recolectado',1)
->get();

$total = 0;

foreach($puntos as $p)
{
    $total += $p->volumen_estimado_kg;
}

$recoleccion->basura_recolectada_ton = $total / 1000;

$recoleccion->hora_fin_real = now();

$recoleccion->estado = $request->estado;

$recoleccion->observaciones = $request->observaciones;

$recoleccion->save();

return redirect('/coordinador/dashboard');

}

}