<?php

namespace App\Observers;

use App\Models\Cliente;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class ClienteObserver
{
  
    public function created(Cliente $cliente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user() ? Auth::user()->nombre : 'El mismo';
        $registro->accion = 'Se creó el cliente: ' . $cliente->nombre;
        $registro->save();
    }

  
    public function updated(Cliente $cliente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se actualizó el cliente: ' . $cliente->nombre;
        $registro->save();
    }

    
    public function deleted(Cliente $cliente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó el cliente: ' . $cliente->nombre;
        $registro->save();
    }
}
