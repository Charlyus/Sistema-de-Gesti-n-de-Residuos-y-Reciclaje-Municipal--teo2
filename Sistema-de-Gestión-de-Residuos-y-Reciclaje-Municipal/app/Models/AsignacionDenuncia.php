<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionDenuncia extends Model
{

protected $table = 'asignaciones_denuncia';

protected $primaryKey = 'id_asignacion';

public $timestamps = false;

protected $fillable = [
'id_denuncia',
'id_cuadrilla',
'fecha_intervencion',
'recursos_estimados',
'foto_despues_url'
];

}