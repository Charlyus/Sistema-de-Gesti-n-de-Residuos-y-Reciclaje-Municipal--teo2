<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Recoleccion extends Model
{
    protected $table = 'recolecciones';
    protected $primaryKey = 'id_recoleccion';
    public $timestamps = false;

    protected $fillable = [
        'id_ruta',
        'id_camion',
        'fecha_programada',
        'hora_inicio_real',
        'hora_fin_real',
        'basura_total_estimada_kg',
        'basura_recolectada_ton',
        'estado',
        'observaciones'
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class,'id_ruta');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class,'id_camion');
    }
}