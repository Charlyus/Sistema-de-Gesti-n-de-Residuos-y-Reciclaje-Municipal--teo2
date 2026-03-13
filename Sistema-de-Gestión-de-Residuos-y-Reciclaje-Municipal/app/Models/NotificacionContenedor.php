<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class NotificacionContenedor extends Model
{

protected $table = 'notificaciones_contenedor';

protected $primaryKey = 'id_notificacion';

public $timestamps = false;

protected $fillable = [
'id_contenedor',
'nivel',
'mensaje'
];

}