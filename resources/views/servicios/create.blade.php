@extends('plantillas.encabezado')
@section('titulo')
    Crear Servicio
@endsection
@section('cuerpo')
    <div class="contenedor-agregar">
        <div class="header-agregar">
            <h1>Añadir nuevo servicio</h1>
        </div>
        <form action="{{ route('servicios.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div-agregar">

                <label for="nombre">Nombre:</label>
                <input class="element-lg" type="text" id="nombre" name="nombre" value={{ old('nombre') }}>
                @error('nombre')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
                <label for="descripcion">Descripción:</label>
                <textarea class="element-lg" id="descripcion" name="descripcion" >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
                <label for="costo">Costo:</label>
                <input class="element-lg" type="number" id="costo" name="costo"value={{ old('costo') }} >
                @error('costo')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
                <label for="imagen">Imagen:</label>
                <div class="contenedor-form-img">
                    <img id="preview" class="img-media" onchange="mostrarImagen(event)">

                    <div class="imagen-file">
                        <label class="imagen-t">Imagen que se mostrara en el perfil:</label>
                        <input class="element-lg" type="file" name="imagen" accept="image/*"

                            onchange="mostrarImagen(event)" >
                            @error('imagen')
                                <div class="alert alert-danger">
                                     {{ $message }}
                                </div>
                            @enderror
                    </div>

                </div>
            </div>
            <input class="element-lg" type="submit" value="Guardar">
        </form>
    </div>
@endsection
