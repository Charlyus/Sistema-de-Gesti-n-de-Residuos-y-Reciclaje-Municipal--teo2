<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CamionController extends Controller
{

    public function crearCamion()
    {

        $conductores = Usuario::where('id_rol',6)->get();

        return view('coordinador.crear_camion',compact('conductores'));

    }


    public function guardarCamion(Request $request)
    {

        Camion::create([
            'placa'=>$request->placa,
            'capacidad_toneladas'=>$request->capacidad,
            'estado'=>$request->estado,
            'conductor_asignado'=>$request->conductor
        ]);

        return back()->with('success','Camión registrado');

    }

}