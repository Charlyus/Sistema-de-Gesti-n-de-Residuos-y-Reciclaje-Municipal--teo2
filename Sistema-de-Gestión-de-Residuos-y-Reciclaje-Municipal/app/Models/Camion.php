<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Camion extends Model
{
    protected $table = 'camiones';
    protected $primaryKey = 'id_camion';
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'capacidad_toneladas',
        'estado',
        'conductor_asignado'
    ];

    public function conductor()
    {
        return $this->belongsTo(Usuario::class,'conductor_asignado');
    }
}