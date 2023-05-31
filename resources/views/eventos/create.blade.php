@extends('plantillas.encabezado')
@section('titulo')
    Crear paquete
@endsection
@section('cuerpo')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <div class="contenedor-agregar">
        <div class="header-agregar">
            <h1>Crear evento</h1>
        </div>
        <form action="{{ route('eventos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="nombre">Nombre:</label>
            <input class="element-lg  validar" type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            @error('nombre')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="descripcion">Descripción:</label>
            <textarea class="element-lg validar" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="fecha">Fecha:</label>
            <input class="element-lg validar" type="date" id="fecha" name="fecha"value="{{ old('fecha') }}">
            @error('fecha')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <label for="horaI">Hora Inicio:</label>
            <input class="element-lg validar" type="time" id="horaI" name="horaI"value="{{ old('horaI') }}">
            @error('horaI')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="horaF">Hora Fin:</label>
            <input class="element-lg validar" type="time" id="horaF" name="horaF"value="{{ old('horaF') }}">
            @error('horaF')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="capacidad">Capacidad:</label>
            <input class="element-lg validar" type="number" id="capacidad" name="capacidad"
                value="{{ old('capacidad') }}">
            @error('capacidad')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label>Servicios:</label>
            @foreach ($servicios as $servicio)
                <div>
                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" class="servicio"
                        onchange="actualizarCosto()" data-costo="{{ $servicio->costo }}">
                    <label>{{ $servicio->nombre }}</label>
                </div>
            @endforeach


            <label for="paquete" style="display: block">Paquetes:</label>

            <select class="element-lg" name="paquete_id" id="opcion" onchange="actualizarCosto()">
                <option class="paquete" value="Seleccionar">
                    Seleccionar
                </option>
                @foreach ($paquetes as $paquete)
                    <option class="paquete" value="{{ $paquete->id }}" data-costo="{{ $paquete->costo }}">
                        {{ $paquete->id }} -> {{ $paquete->nombre }}
                    </option>
                @endforeach
            </select>
            <div id="contenedor-msg">
                <h6 id="error"> </h6>
            </div>


            <div class="contenedor-form-img">
                <img id="preview" class="img-media" onchange="mostrarImagen(event)">

                <div class="imagen-file">
                    <label class="imagen-t">Imagen que se mostrara en el perfil:</label>
                    <input class="element-lg validar" type="file" name="imagen" accept="image/*"
                        onchange="mostrarImagen(event)">
                    @error('imagen')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>


            <div class="costo-evento">
                <input type="hidden" name="costo" id="costo" value="">
                <span>Costo:</span>
                <span name="costo" id="costo-total">0</span>
            </div>

            <input class="element-lg" id="botonGE" type="submit" value="Guardar" onclick="paquete_required(event)">
        </form>
    </div>
    <script src="{{ asset('js/code.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
