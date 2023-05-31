<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Paquete;
use App\Models\Gerente;
use Illuminate\Foundation\Auth\User as Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaquetePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        if ($usuario instanceof Gerente) return true;
        else return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Paquete $paquete): bool
    {
        if ($usuario->id == $paquete->gerente_id) {
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
    public function update(Usuario $usuario, Paquete $paquete): bool
    {
        if ($usuario instanceof Gerente) {
            if ($usuario->id == $paquete->gerente_id) {
                if ($paquete->eventos()->exists()) return false;
                else return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Paquete $paquete): bool
    {
        if ($usuario instanceof Gerente) {
            if ($usuario->id == $paquete->gerente_id) {
                if ($paquete->eventos()->exists()) return false;
                else return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function publicado(?Usuario $usuario, Paquete $paquete): bool
    {
        if ($usuario instanceof Gerente || $paquete->estado == 1) return true;
        else return false;
    }

    public function deleteImg(Usuario $usuario, Paquete $paquete): bool
    {
        if ($usuario->id == $paquete->gerente_id && $usuario instanceof Gerente && !$paquete->eventos()->exists()) return true;
        else return false;
    }
}
