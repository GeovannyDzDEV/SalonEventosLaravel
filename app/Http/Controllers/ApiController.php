<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Gerente;
use App\Models\Paquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function paquetes()
    {
        $paquetes = Paquete::all();
        return response()->json($paquetes);
    }
    public function usuarios()
    {
        $gerentes = Gerente::all();
        $cliente = Cliente::all();
        $usuarios = $gerentes->concat($cliente);
        return response()->json($usuarios);
    }


    public function BuscarPaquete(Request $request)
    {
        $paquete = Paquete::find($request->id);
        return response()->json($paquete);
    }

    public function store(Request $request)
    {
        $gerente = new Gerente();
        $gerente->fill($request->all());
        $gerente->contraseña = Hash::make($request->contraseña);
        $gerente->save();

        return response()->json([
            'res' => true,
            'message' => "Usuario creado correctamente"
        ], 200);
    }

    public function login(Request $request)
    {
        $usuario = Gerente::where('usuario', $request->usuario)->first();
        if (!is_null($usuario) && Hash::check($request->contraseña, $usuario->contraseña)) {

            $token = $usuario->createToken('token_api');
            $accessToken = $token->plainTextToken;
            $expiresAt = now()->addMinutes(10);
            $personalAccessToken = PersonalAccessToken::findToken($accessToken);
            $personalAccessToken->forceFill([
                //'expires_at' => $expiresAt,
                'abilities' => ['create']
            ])->save();

            $usuario->api_token =  $accessToken;
            $usuario->save();

            return response()->json([
                'res' => true,
                'token' =>  $accessToken,
                'expira' => $expiresAt,
                'message' => 'Bienvenido al sistema'
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Usuario incorrecto'
            ], 200);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'res' => true,
            'message' => 'Se cerro sesión correctamente'
        ], 200);
    }
}
