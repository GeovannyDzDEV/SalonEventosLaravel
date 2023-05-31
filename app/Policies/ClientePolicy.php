<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Gerente;
use Illuminate\Foundation\Auth\User as Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        if ($usuario instanceof Cliente) return true;
        else return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        if ($usuario instanceof Cliente) return true;
        if ($usuario instanceof Cliente) return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Cliente $cliente): bool
    {
        if ($usuario instanceof Cliente) return true;
        if ($usuario instanceof Cliente) return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Cliente $cliente): bool
    {
        if ($usuario instanceof Gerente) {
            if($cliente->eventos()->exists()){
                return false;
            }else{
                return true;
            }
        }
        elseif ($usuario instanceof Cliente) return false;
    }

}
