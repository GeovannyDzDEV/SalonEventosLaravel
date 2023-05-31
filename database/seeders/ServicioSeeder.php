<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = new Servicio();
        $servicio->nombre = 'Mantelería';
        $servicio->descripcion = 'Para las mesas';
        $servicio->estado = '1';
        $servicio->costo = '1000';
        $servicio->save();

        $servicio = new Servicio();
        $servicio->nombre = 'Meseros';
        $servicio->descripcion = 'Los mejores meseros';
        $servicio->estado = '1';
        $servicio->costo = '2500';
        $servicio->save();

        $servicio = new Servicio();
        $servicio->nombre = 'Aire acondicionado';
        $servicio->descripcion = 'Para no morir de calor';
        $servicio->estado = '1';
        $servicio->costo = '3000';
        $servicio->save();

    }
}
