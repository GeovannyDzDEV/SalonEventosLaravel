@extends('plantillas.encabezado')

@section('titulo')
    Paquetes
@endsection

@section('cuerpo')
    <div class="container mb-4">
        <div class="header bg-dark text-white py-3">
            <h1>Lista de Paquetes</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
            @foreach ($paquetes as $paquete)
                @can('view', $paquete)
                    <div class="col">
                        <div class="card h-100">
                            <img class="img-paquetes" src="{{ $paquete->imagenMo->imagenMi }}" alt="" >
                            <div class="card-body">
                                <h2 class="card-title">{{ $paquete->nombre }}</h2>
                                <div class="card-text">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icono material-symbols-rounded me-2">group</span>
                                        <p class="mb-0">{{ $paquete->capacidad }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icono material-symbols-rounded me-2">description</span>
                                        <p class="mb-0">{{ $paquete->descripcion }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icono material-symbols-rounded me-2">payments</span>
                                        <p class="mb-0">{{ $paquete->costo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <label
                                    class="estado-label bg-{{ $paquete->estado == 1 ? 'success' : 'danger' }} text-white p-2">
                                    {{ $paquete->estado == 1 ? 'Publicado' : 'No Publicado' }}
                                </label>
                                <div class="opciones">
                                    <a class="icono material-symbols-rounded me-2"
                                        href="{{ route('paquetes.show', $paquete->id) }}">Photo_Library</a>
                                    @can('update', $paquete)
                                        <a class="icono material-symbols-rounded edit me-2"
                                            href="{{ route('paquetes.edit', $paquete) }}">edit</a>
                                    @endcan
                                    @can('delete', $paquete)
                                        <form class="eliminar-alert d-inline-block"
                                            action="{{ route('paquetes.destroy', $paquete) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input class="icono material-symbols-rounded delete" type="submit" value="delete">
                                        </form>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            @endforeach
        </div>
    </div>
@endsection
