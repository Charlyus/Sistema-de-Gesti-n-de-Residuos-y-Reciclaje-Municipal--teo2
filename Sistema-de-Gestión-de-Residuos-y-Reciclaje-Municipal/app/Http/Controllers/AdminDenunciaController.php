<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\EstadoDenuncia;
use App\Models\Cuadrilla;
use App\Models\AsignacionDenuncia;

class AdminDenunciaController extends Controller
{

    public function dashboard()
{
return view('admin.dashboard');
}
public function index()
{

$denuncias = Denuncia::leftJoin('asignaciones_denuncia','denuncias.id_denuncia','=','asignaciones_denuncia.id_denuncia')
->join('usuarios','denuncias.id_usuario','=','usuarios.id_usuario')
->join('estados_denuncia','denuncias.id_estado','=','estados_denuncia.id_estado_denuncia')
->select(
'denuncias.*',
'usuarios.nombre as ciudadano',
'estados_denuncia.nombre as estado',
'asignaciones_denuncia.foto_despues_url'
)
->orderBy('fecha_creacion','desc')
->get();

$estados = EstadoDenuncia::all();
$cuadrillas = Cuadrilla::where('disponibilidad',true)->get();

return view('admin.denuncias',compact('denuncias','estados','cuadrillas'));

}

public function cambiarEstado(Request $request)
{

Denuncia::where('id_denuncia',$request->id_denuncia)
->update([
'id_estado'=>$request->id_estado
]);

return back();

}
public function asignarCuadrilla(Request $request)
{

AsignacionDenuncia::create([

'id_denuncia'=>$request->id_denuncia,
'id_cuadrilla'=>$request->id_cuadrilla,
'fecha_intervencion'=>$request->fecha_intervencion,
'recursos_estimados'=>$request->recursos

]);

// cambiar estado a Asignada (id 3 según tu tabla)
Denuncia::where('id_denuncia',$request->id_denuncia)
->update([
'id_estado'=>3
]);

return back();

}
public function subirFotoDespues(Request $request)
{

$foto = null;

if($request->hasFile('foto_despues')){
$foto = $request->file('foto_despues')->store('limpiezas','public');
}

AsignacionDenuncia::where('id_denuncia',$request->id_denuncia)
->update([
'foto_despues_url'=>$foto
]);

// Cambiar estado a Atendida (id 5)
Denuncia::where('id_denuncia',$request->id_denuncia)
->update([
'id_estado'=>5
]);

return back();

}

}