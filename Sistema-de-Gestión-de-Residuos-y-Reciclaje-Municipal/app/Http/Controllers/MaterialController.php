<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoMaterial;

class MaterialController extends Controller
{

public function create()
{
return view('material.create');
}

public function store(Request $request)
{

TipoMaterial::create([
'nombre'=>$request->nombre
]);

return redirect('/material/list');

}

public function list()
{

$materiales = TipoMaterial::all();

return view('material.list',compact('materiales'));

}

}