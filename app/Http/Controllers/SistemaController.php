<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Gerente;
use App\Models\Paquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SistemaController extends Controller
{

    public function inicio()
    {
        $paquetes = Paquete::all();
        return view('principal', compact('paquetes'));
    }


    //Vista login y registro
    public function login()
    {
        return view('login');
    }
    public function registro()
    {
        return view('registrarse');
    }

    //Sistem de registro de nuevo usurio
    public function registrar(Request $solicitud)
    {
        $nombre = $solicitud->input('nombre');
        $usuario = $solicitud->input('usuario');
        $contraseña = $solicitud->input('contraseña');
        $gerente = Gerente::where('usuario', $nombre)->first();
        $cliente = Cliente::where('usuario', $nombre)->first();

        if (!is_null($cliente)  || !is_null($gerente)) {
            return redirect('registrarse')->with([
                'res' => false,
                'message' => 'Usuario ya registrado'
            ], 200);
        } else {
            $cliente = new Cliente();
            $cliente->nombre = $nombre;
            $cliente->usuario = $usuario;
            $cliente->contraseña = Hash::make($contraseña);
            $cliente->save();
            return redirect('inicio');
        }
    }

    //Sistema de validación de usuario
    public function validar(Request $solicitud)
    {
        $usuario = $solicitud->input('usuario');
        $contraseña = $solicitud->input('contraseña');
        $encontrado = Gerente::where('usuario', $usuario)->first();
        if (is_null($encontrado)) {
            $encontrado = Cliente::where('usuario', $usuario)->first();
            if (is_null($encontrado)) {
                return redirect('login')
                    ->with(['mensaje' => 'Error, usuario no encontrado']);
            } else {
                $contraseña_bd = $encontrado->contraseña;
                $conincide = Hash::check($contraseña, $contraseña_bd);
                if ($conincide) {
                    Auth::guard('guard_clientes')->login($encontrado);
                    $_SESSION['AuthGuard'] = 'guard_clientes';
                    return redirect('@me');
                } else {
                    return redirect('login');
                }
            }
        } else {
            $contraseña_bd = $encontrado->contraseña;
            $conincide = Hash::check($contraseña, $contraseña_bd);
            if ($conincide) {
                Auth::guard('guard_gerentes')->login($encontrado);
                $_SESSION['AuthGuard'] = 'guard_gerentes';
                return redirect('@me');
            } else {
                return redirect('login');
            }
        }
    }


    public function vista()
    {
        $paquetes = Paquete::all();
        return view('principal', compact('paquetes'));
    }


    public function abonar($id)
    {
        $evento = Evento::find($id);
        return view('eventos.abono', compact('evento'));
    }

    public function abonando($id, Request $abononando)
    {
        $evento = Evento::find($id);
        $evento->costo = $evento->costo - $abononando->input('abono');;
        $evento->save();
        return redirect('eventos');
    }

    public function cerrar_sesion()
    {
        Auth::logout();
        return redirect('inicio');
    }


}
