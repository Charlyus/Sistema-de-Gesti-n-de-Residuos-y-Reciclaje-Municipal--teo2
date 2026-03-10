<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\TipoResiduo;

class RutaController extends Controller
{

    public function guardarRuta(Request $request)
{

    $ruta = new Ruta();

    $ruta->nombre_identificador = $request->nombre;

    $ruta->id_zona = $request->id_zona;

    $ruta->id_tipo_residuo = $request->id_tipo_residuo;

    $ruta->horario_inicio = $request->horario_inicio;

    $ruta->horario_fin = $request->horario_fin;

    $puntos = json_decode($request->puntos, true);

    $ruta->lat_inicio = $puntos[0]['lat'];
    $ruta->lng_inicio = $puntos[0]['lng'];

    $ultimo = end($puntos);

    $ruta->lat_fin = $ultimo['lat'];
    $ruta->lng_fin = $ultimo['lng'];

    $ruta->puntos_intermedios = json_encode($puntos);

    // calcular distancia
    $ruta->distancia_km = $this->calcularDistancia($puntos);

    $ruta->save();

    return back()->with('success','Ruta guardada correctamente');
}
    public function crearRuta()
{
    $zonas = Zona::all();
    $tipos = TipoResiduo::all();

    return view('coordinador.crear_ruta', compact('zonas','tipos'));
}

private function calcularDistancia($puntos)
{
    $total = 0;

    for($i=1;$i<count($puntos);$i++)
    {

        $lat1 = deg2rad($puntos[$i-1]['lat']);
        $lon1 = deg2rad($puntos[$i-1]['lng']);

        $lat2 = deg2rad($puntos[$i]['lat']);
        $lon2 = deg2rad($puntos[$i]['lng']);

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat/2) * sin($dlat/2) +
        cos($lat1) * cos($lat2) *
        sin($dlon/2) * sin($dlon/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        $r = 6371;

        $total += $r * $c;
    }

    return $total;
}

}