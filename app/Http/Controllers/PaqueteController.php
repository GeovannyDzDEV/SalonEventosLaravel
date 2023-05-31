<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use App\Http\Requests\StorePaqueteRequest;
use App\Http\Requests\UpdatePaqueteRequest;
use App\Models\imagen;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', App\Models\Paquete::class);
        $paquetes = Paquete::all();
        return view("paquetes.index", compact('paquetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('paquetes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaqueteRequest $request)
    {

        $paquete = new Paquete();
        $paquete->fill($request->all());
        $paquete->gerente_id = auth()->user()->id;
        $paquete->save();

        if ($request->hasFile('imagen')) {
            $imageneF = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imageneF->getClientOriginalName();
            $carga = $request->file('imagen')->move($ruta, $nombreimagen);
            $imgenP = new imagen();
            $imgenP->imagenMi = $ruta . $nombreimagen;
            $imgenP->imagenable_id = $paquete->id;
            $imgenP->imagenable_type = Paquete::class;
            $imgenP->save();
        }

        return redirect(route('paquetes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Paquete $paquete)
    {

        $imagenes = $paquete->albumMo()->with('albumable')->paginate(5);

        if (auth()->user()) {
            $tipo = Paquete::class;
            $id = $paquete->id;
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        } elseif ($paquete->estado == 1) {
            $tipo = Paquete::class;
            $id = $paquete->id;
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paquete $paquete)
    {
        $this->authorize('update', $paquete);
        return view('paquetes.edit', compact('paquete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaqueteRequest $request, Paquete $paquete)
    {
        $this->authorize('update', $paquete);
        $paquete->fill($request->all());
        $paquete->estado = $request->input('estado');
        $paquete->gerente_id = auth()->user()->id;
        $paquete->save();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
            $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
            if ($paquete->imagenMo) {
                $paquete->imagenMo()->update([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $paquete->id,
                    'imagenable_type'  => Paquete::class,
                ]);
            } else {
                $paquete->imagenMo()->create([
                    'imagenMi' => $ruta . $nombreimagen,
                    'imagenable_id'  => $paquete->id,
                    'imagenable_type'  => Paquete::class,
                ]);
            }
        }
        return redirect(route('paquetes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paquete $paquete)
    {
        $this->authorize('delete', $paquete);
        $paquete->delete();
        return redirect(route('paquetes.index'));
    }
}
