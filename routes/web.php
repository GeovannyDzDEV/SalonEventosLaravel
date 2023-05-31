<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\UsuarioController;
use App\Mail\PaqueteMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect('inicio');
});


Route::get('inicio', [SistemaController::class, 'inicio'])->name(('inicio'))->middleware('guest');

//Sistem de logeo y validación
Route::get('login', [SistemaController::class, 'login'])->name(('login'))->middleware('guest');
Route::post('validar', [SistemaController::class, 'validar'])->name('sesion');

//Sistema de registro
Route::get('registrarse', [SistemaController::class, 'registro'])->name(('registrarse'))->middleware('guest');
Route::post('registrar', [SistemaController::class, 'registrar'])->name('registrar')->middleware('guest');

//Validar que rol tiene el usuario
Route::get('@me', [SistemaController::class, 'vista'])->name(("@me"));

//Cerrar sesión
Route::get('cerrar_sesion', [SistemaController::class, 'cerrar_sesion'])->name(("cerrar_sesion"));


Route::resource('usuarios', UsuarioController::class)->except(['edit', 'update', 'destroy']);
Route::get('/edit/{tipoUsuario}/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/update/{tipoUsuario}/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/destroy/{tipoUsuario}/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');


Route::resource('paquetes', PaqueteController::class)->except('show');
Route::get('/album/{paquete}', [PaqueteController::class, 'show'])->name('paquetes.show');
Route::resource('servicios', ServicioController::class);
Route::resource('eventos', EventoController::class);

Route::get('crear/{id}/{tipo}', [AlbumController::class, 'create'])->name('album.create')->middleware('auth');
Route::post('subir/{id}/{tipo}', [AlbumController::class, 'store'])->name('album.store')->middleware('auth');
Route::delete('eliminar/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');


Route::get('abono/{id}', [SistemaController::class, 'abonar'])->name(("abono"));
Route::put('abonando/{id}', [SistemaController::class, 'abonando'])->name(("abonando"));
Route::get('errors', [nuevaa::class, 'ir'])->name(("hola"));


    