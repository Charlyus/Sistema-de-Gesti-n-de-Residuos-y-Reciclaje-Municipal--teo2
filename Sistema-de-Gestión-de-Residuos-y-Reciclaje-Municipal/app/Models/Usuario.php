<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'telefono',
        'id_rol'
    ];

    protected $hidden = ['password'];

    public function rol()
    {
        return $this->belongsTo(Rol::class,'id_rol');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
    public function camiones()
{
    return $this->hasMany(Camion::class,'conductor_asignado');
}
}