<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->revoke();

    return [
        'message' => 'Token revocado correctamente'
    ];
});

Route::post('login', [ApiController::class, 'login']);

Route::get('paquetes', [ApiController::class, 'paquetes']);
Route::get('paquetesBus', [ApiController::class, 'BuscarPaquete']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('usuarios', [ApiController::class, 'usuarios']);
    Route::post('store', [ApiController::class, 'store']);
    Route::get('logout', [ApiController::class, 'logout']);
});
