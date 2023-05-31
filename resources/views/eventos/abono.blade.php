<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abono</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body class="body-abono">


    <form class="card-abono" id="formAbono" action="{{ route('abonando', $evento->id) }}" method="POST">
        @method('PUT')
        @csrf
        <h1 class="titulo-abono">Abonar</h1>

        <div class="card-texto-abono">
            <p>Ingrese la cantidad a abonar al evento {{ $evento->nombre }}</p>
            <h5>Cantidad a abonar</h5>
            <input type="number" placeholder="$100.00" id="abono" name="abono">
            <button class="boton-transferir">Transferir <i class="fas fa-arrow-right"></i></button>
        </div>

    </form>
    <script src="{{ asset('js/code.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/a29382f9c5.js" crossorigin="anonymous"></script>
</body>

</html>
