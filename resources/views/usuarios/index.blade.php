@extends('plantillas.encabezado')
@section('titulo')
    Usuarios
@endsection
@section('cuerpo')
    <div class="contenedor-tabla-usuarios">
        <div class="card-cuerpo">
            <table id="usuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Nacimiento</th>
                        <th>Rol</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        @php
                            if ($usuario instanceof App\Models\Gerente) {
                                $tipoUsuario = 'Gerente';
                            } else {
                                $tipoUsuario = 'Cliente';
                            }
                        @endphp
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->nacimiento }}</td>
                            <td>{{ $tipoUsuario }}</td>
                            <td><img src="{{ optional($usuario->imagenMo)->imagenMi }}" alt="" width="80px">
                            <td>
                                <a href="{{ route('usuarios.edit', ['tipoUsuario' => $tipoUsuario, 'id' => $usuario->id]) }}"
                                    class="icono material-symbols-rounded update">edit</a>

                                @can('delete', $usuario)
                                    <form class="eliminar-alert"
                                        action="{{ route('usuarios.destroy', ['tipoUsuario' => $tipoUsuario, 'id' => $usuario->id]) }}"
                                        method="post" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <input class="icono material-symbols-rounded delete" type="submit" value="delete"
                                            style=" border-width:0">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
