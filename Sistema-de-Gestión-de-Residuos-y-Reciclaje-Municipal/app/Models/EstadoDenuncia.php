<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoDenuncia extends Model
{

protected $table = 'estados_denuncia';

protected $primaryKey = 'id_estado_denuncia';

public $timestamps = false;

protected $fillable = [
'nombre'
];

}