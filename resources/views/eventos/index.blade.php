@extends('plantillas.encabezado')

@section('titulo')
    Editar Usuario
@endsection

@section('cuerpo')
    <div class="container mb-4">
        <div class="header bg-dark text-white py-3">
            <h1>Lista de Eventos</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
            @foreach ($eventos as $evento)
                @can('view', $evento)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ optional($evento->imagenMo)->imagenMi }}" alt="" class="img-fluid" width="550px">
                            <div class="card-body">
                                <h2 class="card-title">{{ $evento->nombre }}</h2>
                                <div class="card-text">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icono material-symbols-rounded me-2">description</span>
                                        <p class="mb-0">{{ $evento->descripcion }}</p>
                                    </div>
                                    <button class="contrato-icon" type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#miVentanaEmergente-{{ $evento->id }}">
                                        Ver Contrato
                                    </button>

                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <label class="estado-label bg-{{ $evento->estado == 1 ? 'success' : 'danger' }} text-white p-2">
                                    {{ $evento->estado == 1 ? 'Confirmado' : 'No Confirmado' }}
                                </label>
                                <div class="opciones">
                                    <a class="icono material-symbols-rounded me-2"
                                        href="{{ route('eventos.show', $evento) }}">Photo_Library</a>
                                    @can('update', $evento)
                                        <a class="icono material-symbols-rounded edit me-2"
                                            href="{{ route('eventos.edit', $evento) }}">edit</a>
                                    @endcan
                                    @can('delete', $evento)
                                        <form class="eliminar-alert d-inline-block" action="{{ route('eventos.destroy', $evento) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input class="icono material-symbols-rounded delete" type="submit" value="delete">
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="miVentanaEmergente-{{ $evento->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Evento: {{ $evento->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Paquete seleccionao: {{ $evento->paquete->nombre }}</p>
                                        <p>Costo: {{ $evento->costo > 0 ? $evento->costo : '0' }}</p>
                                        <p>Descripción evento: {{ $evento->descripcion }}</p>
                                        <div class="horas-c">
                                            <p>Hora de inicio : {{ $evento->horaI }}</p>
                                            <p>Hora de final: {{ $evento->horaF }}</p>
                                        </div>
                                        <p>Invitados: {{ $evento->capacidad }}</p>
                                        <p>Servicios: </p>
                                        <div class="horas-c">
                                            @foreach ($evento->servicios as $servicio)
                                                <p>{{ $servicio->nombre }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        @if ($evento->costo > 0 && $evento->estado == 1)
                                            <a class="abono-boton" href="{{ route('abono', $evento->id) }}"
                                                style="">Realizar un abono</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            @endforeach
        </div>
    </div>
@endsection
