<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Librerias boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- Libreria de iconos google --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- Mis css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/cajas.css') }}" />

    {{-- Titulo de la pagina con yield y section --}}
    <title>@yield('titulo')</title>
</head>

<body>
    <header class="p-3 border-bottom">
        <div class="d-flex flex-wrap align-items-center justify-content-center">
            <a href="{{ route('@me') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img class="logo" src="/imagenes/logo.png">
            </a>

            <ul class="nav col-20 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @auth
                    @if (Auth::user() instanceof App\Models\Gerente)
                        <div class="dropdown">
                            <a href="#" class="link-dark dropdown-toggle px-2" data-bs-toggle="dropdown">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Mostrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('usuarios.create') }}">Agregar</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="link-dark dropdown-toggle  px-2" data-bs-toggle="dropdown">
                                Paquetes
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="{{ route('paquetes.index') }}">Mostrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('paquetes.create') }}">Agregar</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="link-dark dropdown-toggle px-2" data-bs-toggle="dropdown">
                                Servicios
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="{{ route('servicios.index') }}">Mostrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('servicios.create') }}">Agregar</a></li>
                                <li><a class="dropdown-item" href="{{ route('vistaa') }}">Agregar</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="link-dark dropdown-toggle px-2" data-bs-toggle="dropdown">
                                Eventos
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="{{ route('eventos.index') }}">Mostrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('hola') }}">Agregar</a></li>
                            </ul>
                        </div>
                    @elseif (Auth::user() instanceof App\Models\Cliente)
                        <div class="dropdown">
                            <a href="#" class="link-dark dropdown-toggle px-2" data-bs-toggle="dropdown">
                                Eventos
                            </a>
                            <ul class="dropdown-menu text-small">

                                <li><a class="dropdown-item" href="{{ route('eventos.index') }}">Mostrar</a></li>
                                <li><a class="dropdown-item" href="{{ route('eventos.create') }}">Agregar</a></li>
                                <li><a class="dropdown-item" href="{{ route('hola') }}">Agregar</a></li>
                            </ul>
                        </div>
                    @endif
                @endauth
            </ul>

            {{-- Botón de sesión --}}
            @auth
                <div class="dropdown text-end">

                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <h6 style="display: inline; margin-right: 10px"> {{ Auth::user()->nombre }}</h6>

                        <img src="{{ optional(Auth::user()->imagenMo)->imagenMi ? '/' . Auth::user()->imagenMo->imagenMi : 'https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png' }}"
                            width="42" height="42" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">Nuevo proyecto</a></li>
                        <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                        <li><a class="dropdown-item" href="">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('cerrar_sesion') }}">Cerrar sesión</a></li>
                    </ul>
                </div>
            @else
                <li><a class="nav-link px-2 link-secondary" href="{{ route('login') }}">Iniciar sesión</a></li>
                <li><a class="nav-link px-2 link-dark" href="{{ route('registrarse') }}">Registrarse</a></li>
            @endauth
        </div>

    </header>

    <div class="contenido">
        @yield('cuerpo')
    </div>

    <footer>
        <p class="footer-text">© Copyright Arbore</p>
    </footer>



    {{-- Scripts DataTables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

    {{-- Mis Scripts --}}
    
    <script src="{{ asset('js/datatable.js') }}" defer></script>
    <script src="{{ asset('js/code.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Scripts Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
