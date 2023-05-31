<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}" />
    <title>Login</title>
</head>

<body>

    <div class="cabeceraS animate__animated animate__flipInY">
        <div class="cabeceraF">
            <img src="imagenes/logo.png" style="width: 120px;">
        </div>
        <div class="cabeza-login">
            <h1>Inicia sesión</h1>
            <div>Por favor inserta tus datos</div>
        </div>
        <div class="contenedorItems">
            <form action="{{ route('registrar') }}" method="post">
                @csrf
                <div class="items">
                    <span class="icono material-symbols-rounded">person</span>
                    <input class="cajas" name="nombre" type="text" placeholder="Nombre Completo">
                </div>
                <div class="items">
                    <span class="icono material-symbols-rounded">account_circle</span>
                    <input class="cajas" name="usuario" type="text" id="usuario" placeholder="Usuario">
                </div>
                <div class="items">
                    <span class="icono material-symbols-rounded">lock</span>
                    <input class="cajas" name="contraseña" type="password" placeholder="Contraseña">
                </div>
                <div class="items">
                    <span class="icono material-symbols-rounded">lock</span>
                    <input class="cajas" name="contraseña2" type="password" placeholder="Contraseña">
                </div>
                <div class="items">
                    <input class="boton" type="submit">
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/code.js') }}" defer></script>
</body>

</html>
