<?php

namespace App\Http\Controllers;

class CoordinadorController extends Controller
{
    public function dashboard()
    {
        return view('dashboards.coordinador');
    }
}