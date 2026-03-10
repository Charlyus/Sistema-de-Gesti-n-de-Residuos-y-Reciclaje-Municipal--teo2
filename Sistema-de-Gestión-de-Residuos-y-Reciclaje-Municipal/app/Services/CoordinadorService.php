<?php
namespace App\Services;

use App\Models\Ruta;
use App\Models\Recoleccion;
use App\Models\Camion;

class CoordinadorService
{

    public function listarRutas()
    {
        return Ruta::with('zona','tipoResiduo')->get();
    }

    public function programarRecoleccion($data)
    {
        return Recoleccion::create($data);
    }

    public function camionesDisponibles()
    {
        return Camion::where('estado','Operativo')->get();
    }

    public function recoleccionesHoy()
    {
        return Recoleccion::with('ruta','camion')
                ->whereDate('fecha_programada',now())
                ->get();
    }

}