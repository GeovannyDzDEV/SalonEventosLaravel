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
                            <img src="{{ asset('imagenes/meseros.jpg') }}" class="card-img-top" alt="">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
