<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoRecoleccion extends Model
{

    protected $table = 'puntos_recoleccion';
    protected $primaryKey = 'id_punto_rec';
    public $timestamps = false;

    protected $fillable = [
        'id_recoleccion',
        'latitud',
        'longitud',
        'volumen_estimado_kg'
    ];

}