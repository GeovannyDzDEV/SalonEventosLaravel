<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Gerente;
use App\Models\Servicio;
use Illuminate\Foundation\Auth\User as Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicioPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        if($usuario instanceof Gerente) return true;
        else return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Servicio $servicio): bool
    {
        if ($usuario->id == $servicio->gerente_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        if ($usuario instanceof Gerente) return true;
        if ($usuario instanceof Cliente) return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Servicio $servicio): bool
    {
        if ($usuario instanceof Gerente) {
            if ($usuario->id == $servicio->gerente_id) {
                if ($servicio->eventos()->exists()) return false;
                else return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Servicio $servicio): bool
    {
        if ($usuario instanceof Gerente) {
            if ($usuario->id == $servicio->gerente_id) {
                if ($servicio->eventos()->exists()) return false;
                else return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

   
}
