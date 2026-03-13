<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuadrilla extends Model
{

protected $table = 'cuadrillas';

protected $primaryKey = 'id_cuadrilla';

public $timestamps = false;

protected $fillable = [
'nombre_equipo',
'numero_integrantes',
'disponibilidad'
];

}