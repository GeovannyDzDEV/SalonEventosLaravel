@extends('plantillas.encabezado')

@section('titulo')
    Album
@endsection

@section('cuerpo')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card-columns">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="card">
                            <img src="{{ asset('imagenes/boda7.png') }}" class="card-img-top" alt="">
                            @can('deleteImg', $paquete)
                                <div class="card-footer">
                                    <form class="eliminar-alert">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
