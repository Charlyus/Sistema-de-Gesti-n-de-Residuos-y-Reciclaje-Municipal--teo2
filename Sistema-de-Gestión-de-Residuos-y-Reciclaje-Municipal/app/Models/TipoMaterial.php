<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{

protected $table = 'tipos_material';

protected $primaryKey = 'id_tipo_material';

public $timestamps = false;

protected $fillable = [
'nombre'
];

}