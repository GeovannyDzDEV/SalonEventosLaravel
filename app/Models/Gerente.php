<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Gerente extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['nombre', 'usuario', 'nacimiento', 'api_token'];

    public function paquetes()
    {
        return $this->hasMany(Paquete::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function imagenMo()
    {
        return $this->morphOne(Imagen::class, 'imagenable');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
