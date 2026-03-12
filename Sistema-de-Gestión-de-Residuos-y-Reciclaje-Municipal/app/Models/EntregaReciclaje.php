<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntregaReciclaje extends Model
{

protected $table = 'entregas_reciclaje';

protected $primaryKey = 'id_entrega';

public $timestamps = false;

protected $fillable = [
'id_punto_verde',
'id_usuario',
'id_tipo_material',
'cantidad_kg'
];

public function puntoVerde()
{
return $this->belongsTo(PuntoVerde::class,'id_punto_verde');
}

public function material()
{
return $this->belongsTo(TipoMaterial::class,'id_tipo_material');
}

public function usuario()
{
return $this->belongsTo(Usuario::class,'id_usuario');
}

}