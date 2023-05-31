@extends('plantillas.encabezado')
@section('titulo')
    Agregar Usuario
@endsection
@section('cuerpo')
    <div class="contenedor-agregar">
        <div class="header-agregar">
            <h1>Añadir nuevo usuario</h1>
        </div>
        <form action="{{ route('usuarios.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="nombre">Nombre:</label>
            <input class="element-lg" name="nombre" value="{{ old('nombre') }}">
            @error('nombre')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="usuario">Usuario:</label>
            <input class="element-lg" name="usuario" value="{{ old('usuario') }}">
            @error('usuario')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="nacimiento">Fecha de nacimiento:</label>
            <input class="element-lg" type="date" name="nacimiento" value="{{ old('nacimiento') }}">
            @error('nacimiento')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="contraseña">Contraseña:</label>
            <input class="element-lg" name="contraseña" value="{{ old('contraseña') }}">
            @error('contraseña')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="rol">Rol:</label>
            <select class="element-lg" name="rol">
                <option value="">Seleccionar</option>
                <option id="opcion1" value="Gerente" {{ old('rol') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                <option id="opcion2" value="Empleado" {{ old('rol') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                <option id="opcion3" value="Cliente" {{ old('rol') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
            </select>


            <div class="contenedor-form-img">
                <img id="preview" class="img-media" onchange="mostrarImagen(event)">

                <div class="imagen-file">
                    <label class="imagen-t">Imagen que se mostrara en el perfil:</label>
                    <input class="element-lg" type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)"
                        required>
                </div>
            </div>
            <input class="element-lg" type="submit" value="Guardar">
        </form>
    </div>
@endsection
