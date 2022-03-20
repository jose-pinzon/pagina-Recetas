<?php

namespace App\Providers;

use App\CategoriasReceta;
use Illuminate\Support\ServiceProvider;
use View;
class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //!este funciona cuando el proyecto es configurado, algo que no tenga que ver con laravel y registra todo antes de que laravel se cree

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //!este es lo contrario que lo anterior

            View::composer('*', function($view) {
                $categorias = CategoriasReceta::all();
                $view->with('categorias', $categorias);
            });

    }
}
