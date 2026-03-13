<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{

protected $table = 'denuncias';

protected $primaryKey = 'id_denuncia';

public $timestamps = false;

protected $fillable = [
'id_usuario',
'descripcion',
'latitud',
'longitud',
'foto_url',
'tamano',
'id_estado'
];

}