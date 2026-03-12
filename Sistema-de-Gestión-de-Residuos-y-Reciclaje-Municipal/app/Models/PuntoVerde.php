<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoVerde extends Model
{

protected $table = 'puntos_verdes';

protected $primaryKey = 'id_punto_verde';

public $timestamps = false;

protected $fillable = [
'nombre',
'direccion',
'latitud',
'longitud',
'capacidad_total_m3',
'horario_atencion',
'encargado_id'
];

}