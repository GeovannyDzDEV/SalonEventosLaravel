@extends('plantillas.encabezado')

@section('cuerpo')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/pagination/bootstrap-4.css') }}">


    .<div class="container">
        <div class="row">
            <div class="col">
                <h1>Subir imagenes</h1>
                <form action="{{ route('album.store', ['id' => $id, 'tipo' => $tipo]) }}" method="POST" class="dropzone" id="my-Awesome-Dropzone">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo",
            acceptedFiles: "image/*",
        };
    </script>
@endsection