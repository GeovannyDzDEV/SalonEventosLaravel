<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Models\imagen;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', App\Models\Servicio::class);
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicioRequest $request)
    {
        $servicio = new Servicio();
        $servicio->fill($request->all());
        $servicio->gerente_id = auth()->user()->id;
        $servicio->save();


        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
            $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
            $imgenU = new imagen();
            $imgenU->imagenMi = $ruta . $nombreimagen;
            $imgenU->imagenable_id = $servicio->id;
            $imgenU->imagenable_type = Servicio::class;
            $imgenU->save();
        }
        return redirect(route('servicios.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        $imagenes = $servicio->albumMo()->with('albumable')->paginate(5);
        if (auth()->user()) {
            $tipo = Servicio::class;
            $id = $servicio->id;
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        } elseif ($servicio->estado == 1) {
            $tipo = Servicio::class;
            $id = $servicio->id;
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicioRequest $request, Servicio $servicio)
    {
        $servicio->fill($request->all());
        $servicio->estado = $request->input('estado');
        $servicio->save();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
            $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
            if ($servicio->imagenMo) {
                $servicio->imagenMo()->update([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $servicio->id,
                    'imagenable_type'  => Servicio::class,
                ]);
            } else {
                $servicio->imagenMo()->create([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $servicio->id,
                    'imagenable_type'  => Servicio::class,
                ]);
            }
        }
        return redirect(route('servicios.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $this->authorize('delete', $servicio);
        $servicio->delete();
        return redirect(route('servicios.index'));
    }
}
