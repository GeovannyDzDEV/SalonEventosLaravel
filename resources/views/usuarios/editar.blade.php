@extends('plantillas.encabezado')
@section('titulo')
    Editar Usuario
@endsection
@section('cuerpo')
    <div class="contenedor-agregar">
        <div class="header-agregar">
            <h1>Editar Usuario</h1>
        </div>
        <form action="{{ route('usuarios.update', ['tipoUsuario' => $tipoUsuario, 'id' => $usuario->id]) }}" method="post"
            enctype="multipart/form-data">

            @method('PUT')
            @csrf

            <label for="nombre">Nombre:</label>
            <input class="element-lg" type="text" id="nombre" name="nombre"
                value="{{ old('nombre', $usuario->nombre) }}">
            @error('nombre')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="usuario">Usuario:</label>
            <input class="element-lg" id="usuario" id="usuario" name="usuario"
                value="{{ old('usuario', $usuario->usuario) }}">
            @error('usuario')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="nacimiento">Fecha de nacimiento:</label>
            <input class="element-lg" type="date" id="nacimiento" name="nacimiento"
                value="{{ old('nacimiento', $usuario->nacimiento) }}">
            @error('nacimiento')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="contraseña">Contraseña:</label>
            <input class="element-lg" type="password" name="contraseña"
                value="{{ old('contraseña') }}">
            @error('contraseña')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <label for="rol">Rol:</label>
            <div class="element-lg" name="rol">
                @if ($usuario instanceof App\Models\Gerente)
                    <a>Gerente</a>
                @else
                    <a>Cliente</a>
                @endif
            </div>

            <div class="contenedor-form-img">
                <img id="preview" class="img-media" src="{{ asset(optional($usuario->imagenMo)->imagenMi) }}"
                    onchange="mostrarImagen(event)" class="img-fluid">

                <div class="imagen-file">
                    <label class="imagen-t">Imagen que se mostrara en el post:</label>
                    <input type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                </div>
            </div>

            <input class="element-lg" type="submit" value="Guardar">
        </form>
    </div>
@endsection
