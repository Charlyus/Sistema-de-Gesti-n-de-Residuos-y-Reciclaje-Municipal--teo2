<?php

namespace App\Http\Controllers;

class OperadorController extends Controller
{
    public function dashboard()
    {
        return view('dashboards.operador');
    }
}