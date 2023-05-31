<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Gerente;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = new Gerente();
        $usuario->nombre = 'Carlos';
        $usuario->usuario='Carlos';
        $usuario->contraseña = Hash::make('g'); //a
        $usuario->nacimiento = '2001-01-14';
        $usuario->save();

        $usuario = new Cliente();
        $usuario->nombre = 'Hugo';
        $usuario->usuario='Hugo';
        $usuario->contraseña = Hash::make('c'); //b
        $usuario->nacimiento = '2001-08-18';
        $usuario->save();

        $usuario = new Cliente();
        $usuario->nombre = 'Paco';
        $usuario->usuario='Paco';
        $usuario->contraseña = Hash::make('c'); //c
        $usuario->nacimiento = '2001-05-12';
        $usuario->save();

        $usuario = new Cliente();
        $usuario->nombre = 'Luis';
        $usuario->usuario='Luis';
        $usuario->contraseña = Hash::make('c'); //c
        $usuario->nacimiento = '2001-05-12';
        $usuario->save();
    }
    
}
