<?php

namespace App\Observers;

use App\Models\Paquete;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
class PaqueteObserver
{
    
    public function created(Paquete $paquete): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se creó el paquete: ' . $paquete->nombre;
        $registro->save();
    }

    public function updated(Paquete $paquete): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se actualizó el paquete: ' . $paquete->nombre;
        $registro->save();
    }

   
    public function deleted(Paquete $paquete): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó el paquete: ' . $paquete->nombre;
        $registro->save();
    }


}
