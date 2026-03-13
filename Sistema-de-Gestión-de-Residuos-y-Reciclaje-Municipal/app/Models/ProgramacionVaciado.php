<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProgramacionVaciado extends Model
{

protected $table='programacion_vaciado';

protected $primaryKey='id_programacion';

public $timestamps=false;

protected $fillable=[
'id_contenedor',
'id_recolector',
'fecha_programada',
'estado',
'observaciones'
];

}