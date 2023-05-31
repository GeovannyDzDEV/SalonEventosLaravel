<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Cliente;
use App\Models\Gerente;
use App\Models\imagen;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', App\Models\Cliente::class);
        $gerentes =  Gerente::with('imagenMo')->get();
        $clientes = Cliente::with('imagenMo')->get();
        $usuarios = $gerentes->concat($clientes);
        return view("usuarios.index", compact('usuarios'));
    }

    public function create()
    {
        $this->authorize('create', App\Models\Cliente::class);
        return view("usuarios.agregar");
    }

    public function store(StoreUsuarioRequest $request)
    {
        $this->authorize('create', App\Models\Cliente::class);
        if ($request->input('rol') == 'Gerente') {
            $usuario = new Gerente();
            $tipo =  Gerente::class;
        } else {
            $usuario = new Cliente();
            $tipo = Cliente::class;
        }

        $usuario->fill($request->all());
        $usuario->contraseña = Hash::make($request->input('contraseña'));
        $usuario->save();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
            $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
            $imgenU = new imagen();
            $imgenU->imagenMi = $ruta . $nombreimagen;
            $imgenU->imagenable_id = $usuario->id;
            $imgenU->imagenable_type = $tipo;
            $imgenU->save();
        }

        return redirect(route('usuarios.index'));
    }

    public function show($usuario)
    {
        //
    }

    public function edit($tipoUsuario, $id)
    {

        if ($tipoUsuario == 'Gerente') {
            $usuario = Gerente::where('id', $id)->first();
            if (is_null($usuario)) return view('errors.404');
        } else {
            $usuario = Cliente::where('id', $id)->first();
            if (is_null($usuario)) return view('errors.404');
        }
        $this->authorize('update', $usuario);
        return view('usuarios.editar', compact('usuario', 'tipoUsuario'));
    }

    public function update(UpdateUsuarioRequest $request, $tipoUsuario, $id)
    {
        if ($tipoUsuario == 'Gerente') {
            $usuario = Gerente::where('id', $id)->first();
            $tipo =  Gerente::class;
        } else {
            $usuario = Cliente::where('id', $id)->first();
            $tipo =  Cliente::class;
        }
        $this->authorize('update', $usuario);

        $usuario->fill($request->all());
     
        $usuario->save();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
            $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
            if ($usuario->imagenMo) {
                $usuario->imagenMo()->update([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $usuario->id,
                    'imagenable_type'  => $tipo,
                ]);
            } else {
                $usuario->imagenMo()->create([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $usuario->id,
                    'imagenable_type'  => $tipo,
                ]);
            }
        }
        return redirect(route('usuarios.index'));
    }

    public function destroy($tipoUsuario, $id)
    {
        if ($tipoUsuario == 'Gerente') {
            $usuario = Gerente::where('id', $id)->first();
        } else {
            $usuario = Cliente::where('id', $id)->first();
        }
        $this->authorize('delete', $usuario);

        $usuario->delete();
        return redirect(route('usuarios.index'));
    }
}
