<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=['nombre','usuario','nacimiento'];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function imagenMo()
    {
        return $this->morphOne(Imagen::class, 'imagenable');
    }
}
