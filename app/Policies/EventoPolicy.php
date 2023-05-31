<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Gerente;
use Illuminate\Foundation\Auth\User as Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;


class EventoPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        if ($usuario instanceof Cliente) return true;
        if ($usuario instanceof Cliente) return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Evento $evento): bool
    {
        if ($usuario->id == $evento->cliente_id) return true;
        if ($usuario instanceof Cliente) return true;
        else return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        if ($usuario instanceof Cliente) return true;
        else return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Evento $evento): bool
    {
        if ($usuario instanceof Gerente) {
            if ($evento->estado == '0') {
                return true;
            } else {
                return false;
            }
        };
        if ($usuario->id == $evento->cliente_id) {
            if ($evento->estado == '0') {
                return true;
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
    public function delete(Usuario $usuario, Evento $evento): bool
    {
        if ($usuario instanceof Gerente) {
            if ($evento->estado == '0') {
                return true;
            } else {
                return false;
            }
        };
        if ($usuario->id == $evento->cliente_id) {
            if ($evento->estado == '0') {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
