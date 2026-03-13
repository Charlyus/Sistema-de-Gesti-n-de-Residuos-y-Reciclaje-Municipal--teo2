<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\AsignacionDenuncia;

class DenunciaController extends Controller
{
    

public function create()
{
return view('denuncia.create');
}
    public function store(Request $request)
{
    $request->validate([
        'descripcion'=>'required',
        'latitud'=>'required',
        'longitud'=>'required',
        'tamano'=>'required'
        ]);

$foto = null;

if($request->hasFile('foto')){
$foto = $request->file('foto')->store('denuncias','public');
}

Denuncia::create([

'id_usuario' => Session::get('usuario')->id_usuario,
'descripcion'=>$request->descripcion,
'latitud'=>$request->latitud,
'longitud'=>$request->longitud,
'foto_url'=>$foto,
'tamano'=>$request->tamano,
'id_estado'=>1

]);

return redirect('/denuncia/mis-denuncias');

}
public function misDenuncias()
{

$denuncias = Denuncia::where('id_usuario',Session::get('usuario')->id_usuario)
->join('estados_denuncia','denuncias.id_estado','=','estados_denuncia.id_estado_denuncia')
->select('denuncias.*','estados_denuncia.nombre as estado')
->orderBy('fecha_creacion','desc')
->get();

return view('denuncia.mis_denuncias',compact('denuncias'));

}

}