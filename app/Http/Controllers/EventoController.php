<?php

namespace App\Http\Controllers;

use App\Events\EventoEvent;
use App\Models\Evento;
use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Imagen;
use App\Models\Paquete;
use App\Models\Servicio;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', App\Models\Evento::class);
        $eventos = Evento::with('paquete', 'servicios', 'imagenMo')->get();
        return view('eventos.index', compact('eventos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', App\Models\Evento::class);
        $servicios = Servicio::where('estado', '1')->get();
        $paquetes = Paquete::where('estado', '1')->get();
        return view('eventos.create', compact('paquetes', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventoRequest $request)
    {

        $usuario = Auth::user();
        $paquete = Paquete::find($request->input('paquete_id'));
        $evento = new Evento();
        $evento->nombre = $request->input('nombre');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = $request->input('fecha');
        $evento->horaI = $request->input('horaI');
        $evento->horaF = $request->input('horaF');
        $evento->capacidad = $request->input('capacidad');
        $evento->costo = $request->input('costo');
        $evento->cliente_id = $usuario->id;
        $evento->paquete_id = $paquete->id;
        $evento->save();
        $evento->servicios()->sync($request->input('servicios'));

        if ($request->hasFile('imagen')) {
            $imageneF = $request->file('imagen');
            $ruta = 'imagenes/';
            $nombreimagen = time() . '-' . $imageneF->getClientOriginalName();
            $carga = $request->file('imagen')->move($ruta, $nombreimagen);
            $imgenP = new Imagen();
            $imgenP->imagenMi = $ruta . $nombreimagen;
            $imgenP->imagenable_id = $evento->id;
            $imgenP->imagenable_type = Evento::class;
            $imgenP->save();
        }

        return redirect(route('eventos.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        if (auth()->user()) {
            $tipo = Evento::class;
            $id = $evento->id;
            $imagenes = $evento->albumMo()->paginate(10);
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        } elseif ($evento->estado == '1') {
            $tipo = Evento::class;
            $id = $evento->id;
            $imagenes = $evento->albumMo()->paginate(10);
            return view('album.index', compact('imagenes', 'id', 'tipo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        $this->authorize('update', $evento);
        $evento->load('servicios');
        $servicios = Servicio::where('estado', '1')->get();
        $paquetes = Paquete::where('estado', '1')->get();
        return view('eventos.edit', compact('evento', 'servicios', 'paquetes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventoRequest $request, Evento $evento)
    {
        $this->authorize('update', $evento);

        if ($request->input('estado') == 1) {
            $evento->estado = $request->input('estado');
            Event::dispatch(new EventoEvent($evento->nombre, $evento->id));
            $evento->save();
        } else {
            $cliente = Auth::user();
            $paquete = Paquete::find($request->input('paquete_id'));
            $evento->nombre = $request->input('nombre');
            $evento->descripcion = $request->input('descripcion');
            $evento->fecha = $request->input('fecha');
            $evento->horaI = $request->input('horaI');
            $evento->horaF = $request->input('horaF');

            $evento->capacidad = $request->input('capacidad');
            $evento->costo = $request->input('costo');
            $evento->cliente_id = $cliente->id;
            $evento->paquete_id = $paquete->id;
            $evento->save();

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $ruta = 'imagenes/';
                $nombreimagen = time() . '-' . $imagen->getClientOriginalName();
                $carga =  $request->file('imagen')->move($ruta, $nombreimagen);
                if ($evento->imagenMo) {
                    $evento->imagenMo()->update([
                        'imagenMi' => $ruta . $nombreimagen,
                        'imagenable_id'  => $evento->id,
                        'imagenable_type'  => Evento::class,
                    ]);
                } else {
                    $evento->imagenMo()->create([
                        'imagenMi' => $ruta . $nombreimagen,
                        'imagenable_id'  => $evento->id,
                        'imagenable_type'  => Evento::class,
                    ]);
                }
            }

            $evento->servicios()->sync($request->input('servicios'));
        }
        return redirect(route('eventos.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        $this->authorize('delete', $evento);
        $evento->delete();
        return redirect(route('eventos.index'));
    }
}
