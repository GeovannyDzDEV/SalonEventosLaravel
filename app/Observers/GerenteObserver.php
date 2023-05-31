<?php

namespace App\Observers;

use App\Models\Gerente;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class GerenteObserver
{

    public function created(Gerente $gerente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se creó el gerente: ' . $gerente->nombre;
        $registro->save();
    }


    public function updated(Gerente $gerente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se actualizó el gerente: ' . $gerente->nombre;
        $registro->save();
    }


    public function deleted(Gerente $gerente): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó el gerente: ' . $gerente->nombre;
        $registro->save();
    }
}
//PRIMERO, CREAR EL OBSERVER REFERENTE AL MODELO (EN SINGULAR Y CON LA INICIAL MAYUSCULA)
//SEGUNDO, LO DE ACA xd