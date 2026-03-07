<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{

    public function handle($request, Closure $next, $role)
    {

        $usuario = Session::get('usuario');

        if(!$usuario){
            return redirect('/login');
        }

        if($usuario->rol->nombre != $role){
            abort(403,'No autorizado');
        }

        return $next($request);
    }

}