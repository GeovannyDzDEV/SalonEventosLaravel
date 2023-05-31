<?php

namespace App\Observers;

use App\Models\Album;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class AlbumObserver
{
    
    public function created(Album $album): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se agregó la imagen al album ' . $album->album;
        $registro->save();
    }

    public function deleted(Album $album): void
    {
        $registro = new Registro();
        $registro->usuario = Auth::user()->nombre;
        $registro->accion = 'Se eliminó la imagen del album ' . $album->album;
        $registro->save();
    }

}
