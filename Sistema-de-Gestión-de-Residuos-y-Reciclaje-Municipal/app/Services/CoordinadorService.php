<?php
namespace App\Services;

use App\Models\Ruta;
use App\Models\Recoleccion;
use App\Models\Camion;
use App\Models\PuntoRecoleccion;

class CoordinadorService
{

    public function listarRutas()
    {
        return Ruta::with('zona','tipoResiduo')->get();
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
    public function programarRecoleccion($data)
{

    $ruta = Ruta::find($data['id_ruta']);
    $camion = Camion::find($data['id_camion']);

    $puntosRuta = json_decode($ruta->puntos_intermedios,true);

    $cantidad = rand(15,30);

    $puntosGenerados = [];

    $total = 0;

    for($i=0;$i<$cantidad;$i++)
{

    // elegir segmento de la ruta
    $index = rand(0, count($puntosRuta)-2);

    $p1 = $puntosRuta[$index];
    $p2 = $puntosRuta[$index+1];

    // interpolación entre los dos puntos
    $t = rand(0,100) / 100;

    $lat = $p1['lat'] + ($p2['lat'] - $p1['lat']) * $t;
    $lng = $p1['lng'] + ($p2['lng'] - $p1['lng']) * $t;

    // pequeña variación
    $lat += rand(-20,20) / 100000;
    $lng += rand(-20,20) / 100000;

    $volumen = rand(50,500);

    $puntosGenerados[] = [
        'lat'=>$lat,
        'lng'=>$lng,
        'volumen'=>$volumen
    ];

    $total += $volumen;

}

    // convertir toneladas a kg
    $capacidadKg = $camion->capacidad_toneladas * 1000;

    // validar capacidad
    if($total > $capacidadKg)
    {
        throw new \Exception("La basura estimada supera la capacidad del camión");
    }

    $recoleccion = Recoleccion::create([
        'id_ruta'=>$data['id_ruta'],
        'id_camion'=>$data['id_camion'],
        'fecha_programada'=>$data['fecha_programada'],
        'basura_total_estimada_kg'=>$total,
        'estado'=>'Programada'
    ]);

    foreach($puntosGenerados as $p)
    {

        PuntoRecoleccion::create([
            'id_recoleccion'=>$recoleccion->id_recoleccion,
            'latitud'=>$p['lat'],
            'longitud'=>$p['lng'],
            'volumen_estimado_kg'=>$p['volumen']
        ]);

    }

    return $recoleccion;

}

}