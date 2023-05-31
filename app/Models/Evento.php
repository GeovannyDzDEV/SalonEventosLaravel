<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class)->withTimestamps();;
    }

    public function imagenMo(){
        return $this->morphOne(Imagen::class, 'imagenable');
    }
    
    public function albumMo(){
        return $this->morphMany(Album::class, 'albumable');
    }
}
