<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{

protected $table = 'contenedores';

protected $primaryKey = 'id_contenedor';

public $timestamps = false;

protected $fillable = [
'id_punto_verde',
'id_tipo_material',
'capacidad_kg',
'ultima_limpieza'
];

public function puntoVerde()
{
return $this->belongsTo(PuntoVerde::class,'id_punto_verde');
}

public function material()
{
return $this->belongsTo(TipoMaterial::class,'id_tipo_material');
}

}