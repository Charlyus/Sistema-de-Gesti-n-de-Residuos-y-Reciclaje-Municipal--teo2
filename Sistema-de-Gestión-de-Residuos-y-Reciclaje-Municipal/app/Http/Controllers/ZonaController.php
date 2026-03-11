<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class ZonaController extends Controller
{

    public function create()
    {
        return view('zona.create');
    }

    public function store(Request $request)
{

Zona::create([
    'nombre'=>$request->nombre,
    'densidad_poblacional'=>$request->densidad_poblacional
]);

return redirect('/coordinador/dashboard');

}
}