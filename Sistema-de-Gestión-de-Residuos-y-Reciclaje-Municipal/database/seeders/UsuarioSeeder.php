<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Operador',
            'correo' => 'operador@gmail.com',
            'password' => Hash::make('12345678'),
            'id_rol' => 3
        ]);
    }
}
