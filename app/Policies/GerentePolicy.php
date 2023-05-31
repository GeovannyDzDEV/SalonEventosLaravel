<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Gerente;
use Illuminate\Foundation\Auth\User as Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class GerentePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        if ($usuario instanceof Gerente) return true;
        if ($usuario instanceof Cliente) return false;
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
    public function update(Usuario $usuario, Gerente $gerente): bool
    {
        if ($usuario instanceof Gerente) return true;
        if ($usuario instanceof Cliente) return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Gerente $gerente): bool
    {
        if ($usuario instanceof Gerente) return true;
        if ($usuario instanceof Cliente) return false;
    }
}
