<?php

namespace App\Observers;

use App\Models\Evento;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
class EventoObserver
{
   
    public function created(Evento $evento): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se creó el evento: ' . $evento->nombre;
        $registro->save();
    }

 
    public function updated(Evento $evento): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se actualizó el evento: ' . $evento->nombre;
        $registro->save();
    }

 
    public function deleted(Evento $evento): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó el evento: ' . $evento->nombre;
        $registro->save();
    }

}
