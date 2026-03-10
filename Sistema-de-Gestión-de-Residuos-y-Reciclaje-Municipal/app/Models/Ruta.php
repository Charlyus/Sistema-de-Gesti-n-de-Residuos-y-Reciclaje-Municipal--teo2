<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'rutas';
    protected $primaryKey = 'id_ruta';
    public $timestamps = false;

    protected $fillable = [
        'nombre_identificador',
        'id_zona',
        'lat_inicio',
        'lng_inicio',
        'lat_fin',
        'lng_fin',
        'puntos_intermedios',
        'distancia_km',
        'horario_inicio',
        'horario_fin',
        'id_tipo_residuo'
    ];

    protected $casts = [
        'puntos_intermedios' => 'array'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class,'id_zona');
    }

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class,'id_tipo_residuo');
    }

    public function dias()
    {
        return $this->belongsToMany(
            Dia::class,
            'ruta_dias',
            'id_ruta',
            'id_dia'
        );
    }
}