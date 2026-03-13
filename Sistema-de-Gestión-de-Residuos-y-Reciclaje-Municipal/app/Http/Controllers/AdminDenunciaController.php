<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\EstadoDenuncia;

class AdminDenunciaController extends Controller
{

    public function dashboard()
{
return view('admin.dashboard');
}
public function index()
{

$denuncias = Denuncia::join('usuarios','denuncias.id_usuario','=','usuarios.id_usuario')
->join('estados_denuncia','denuncias.id_estado','=','estados_denuncia.id_estado_denuncia')
->select(
'denuncias.*',
'usuarios.nombre as ciudadano',
'estados_denuncia.nombre as estado'
)
->orderBy('fecha_creacion','desc')
->get();

$estados = EstadoDenuncia::all();

return view('admin.denuncias',compact('denuncias','estados'));

}

public function cambiarEstado(Request $request)
{

Denuncia::where('id_denuncia',$request->id_denuncia)
->update([
'id_estado'=>$request->id_estado
]);

return back();

}

}