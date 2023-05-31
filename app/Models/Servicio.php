<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable=['nombre','descripcion','costo'];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class);
    }

    public function gerente(){
        return $this->belongsTo(Gerente::class);
    }

    public function imagenMo()
    {
        return $this->morphOne(Imagen::class, 'imagenable');
    }

    public function albumMo()
    {
        return $this->morphMany(Album::class, 'albumable');
    }

}
