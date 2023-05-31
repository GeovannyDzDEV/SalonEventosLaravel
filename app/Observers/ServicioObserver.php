<?php

namespace App\Observers;

use App\Models\Servicio;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
class ServicioObserver
{
   
    public function created(Servicio $servicio): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se creó el servicio: ' . $servicio->nombre;
        $registro->save();
    }

 
    public function updated(Servicio $servicio): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se actualizó el servicio: ' . $servicio->nombre;
        $registro->save();
    }

  
    public function deleted(Servicio $servicio): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó el servicio: ' . $servicio->nombre;
        $registro->save();
    }

}
