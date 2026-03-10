<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{

    protected $table = 'dias';
    protected $primaryKey = 'id_dia';
    public $timestamps = false;

    protected $fillable = [
        'nombre_dia'
    ];

    public function rutas()
    {

        return $this->belongsToMany(
            Ruta::class,
            'ruta_dias',
            'id_dia',
            'id_ruta'
        );

    }

}