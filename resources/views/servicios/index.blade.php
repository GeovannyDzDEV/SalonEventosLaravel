@extends('plantillas.encabezado')

@section('titulo')
    Servicios
@endsection

@section('cuerpo')
    <div class="container mb-4">
        <div class="header bg-dark text-white py-3">
            <h1>Lista de servicios</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
            @foreach ($servicios as $servicio)
                @can('view', $servicio)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $servicio->imagenMo->imagenMi }}" alt="" class="img-fluid" width="550px">
                            <div class="card-body">
                                <h2 class="card-title">{{ $servicio->nombre }}</h2>
                                <div class="card-text">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icono material-symbols-rounded me-2">description</span>
                                        <p class="mb-0">{{ $servicio->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <label
                                    class="estado-label bg-{{ $servicio->estado == 1 ? 'success' : 'danger' }} text-white p-2">
                                    {{ $servicio->estado == 1 ? 'Publicado' : 'No Publicado' }}
                                </label>
                                <div class="opciones">
                                    <a class="icono material-symbols-rounded me-2"
                                        href="{{ route('servicios.show', $servicio->id) }}">Photo_Library</a>
                                    @can('update', $servicio)
                                        <a class="icono material-symbols-rounded edit me-2"
                                            href="{{ route('servicios.edit', $servicio->id) }}">edit</a>
                                    @endcan
                                    @can('delete', $servicio)
                                        <form class="eliminar-alert d-inline-block"
                                            action="{{ route('servicios.destroy', $servicio->id) }}" method="POST">
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
