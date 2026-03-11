<?php

namespace App\Http\Controllers;

use App\Services\CoordinadorService;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{

    protected $service;

    public function __construct(CoordinadorService $service)
    {
        $this->service = $service;
    }

    public function dashboard()
    {
        $recolecciones = $this->service->recoleccionesHoy();

        return view('coordinador.dashboard',compact('recolecciones'));
    }

    public function programar()
    {
        $camiones = $this->service->camionesDisponibles();
        $rutas = $this->service->listarRutas();

        return view('coordinador.programar',compact('camiones','rutas'));
    }

    public function guardarProgramacion(Request $request)
{

    try{

        $this->service->programarRecoleccion($request->all());

        return back()->with('success','Recolección programada');

    }
    catch(\Exception $e){

        return back()->with('error',$e->getMessage());

    }

}


}