<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $usuario = $this->authService->login(
            $request->correo,
            $request->password
        );

        if(!$usuario){
            return back()->with('error','Credenciales incorrectas');
        }

        Session::put('usuario',$usuario);

        // redireccion por rol

        switch($usuario->rol->nombre){

            case 'Administrador':
                return redirect('/admin/dashboard');

            case 'Coordinador':
                return redirect('/coordinador/dashboard');

            case 'Operador':
                return redirect('/operador/dashboard');

            default:
                return redirect('/');

        }

    }

    public function logout()
    {
        Session::forget('usuario');
        return redirect('/login');
    }
}