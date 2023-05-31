<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Aceptado</title>
</head>

<body class="body-mensaje">



    <main class="main-mensaje">
        <h1>Evento {{$evento}}</h1>
        <p>Tu evento {{$evento}} ha sido aceptado, muchas gracias por comprar con nosotros, atentamente el equipo de albore</p>
        <a href="http://127.0.0.1:8000/eventos">Ver eventos</a>
    </main>

</body>

</html>
