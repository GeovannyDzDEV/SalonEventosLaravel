<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Paquete extends Authenticatable
{
    use HasFactory;
    protected $fillable=['nombre','capacidad','costo','descripcion'];

    public function eventos(){
        return $this->hasMany(Evento::class);
    }

    public function gerente(){
        return $this->belongsTo(Gerente::class);
    }

    public function imagenMo(){
        return $this->morphOne(Imagen::class, 'imagenable');
    }

    public function albumMo(){
        return $this->morphMany(Album::class, 'albumable');
    }
}
