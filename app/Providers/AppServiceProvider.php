<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Gerente;
use App\Models\Paquete;
use App\Models\Servicio;
use App\Observers\AlbumObserver;
use App\Observers\ClienteObserver;
use App\Observers\EventoObserver;
use App\Observers\GerenteObserver;
use App\Observers\PaqueteObserver;
use App\Observers\ServicioObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Paginator::defaultView('vendor.pagination.bootstrap-4');
      Gerente::observe(GerenteObserver::class); //Creando el de gerente
      Cliente::observe(ClienteObserver::class);//Creando el CLiente
      Paquete::observe(PaqueteObserver::class);// Creando el Paquete
      Evento::observe(EventoObserver::class);//Creando el Evento
      Servicio::observe(ServicioObserver::class);//Servicio
      Album::observe(AlbumObserver::class);//Creando el Album
    }
}
