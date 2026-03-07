<?php
namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function login($correo,$password)
    {

        $usuario = Usuario::with('rol')
                    ->where('correo',$correo)
                    ->first();

        if(!$usuario){
            return null;
        }

        if(!Hash::check($password,$usuario->password)){
            return null;
        }

        return $usuario;

    }

}


