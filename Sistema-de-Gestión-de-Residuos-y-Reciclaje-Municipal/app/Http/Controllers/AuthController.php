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
        return view('login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = $this->authService->login(
            $request->correo,
            $request->password
        );

        if (!$usuario) {
            return back()->with('error','Credenciales incorrectas');
        }

        Session::put('usuario', $usuario);

        return redirect('/dashboard');
    }

    public function logout()
    {
        Session::forget('usuario');
        return redirect('/login');
    }
}