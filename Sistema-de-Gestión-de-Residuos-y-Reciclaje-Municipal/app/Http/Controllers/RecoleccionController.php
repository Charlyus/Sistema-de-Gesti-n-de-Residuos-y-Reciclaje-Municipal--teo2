<?php

namespace App\Http\Controllers;

use App\Models\Recoleccion;
use App\Models\PuntoRecoleccion;

class RecoleccionController extends Controller
{

    public function verMapa($id)
    {

        $recoleccion = Recoleccion::with('ruta')->findOrFail($id);

        $puntos = PuntoRecoleccion::where('id_recoleccion',$id)->get();

        return view('coordinador.mapa_recoleccion',compact('recoleccion','puntos'));

    }

}