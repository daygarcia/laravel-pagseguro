<?php

namespace PagSeguro;

use Illuminate\Support\ServiceProvider;
use PagSeguro\PagSeguro;

class PagSeguroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    public function register()
    {
        $this->app->singleton('pagseguro', function () {
            return new PagSeguro();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/pagseguro.php' => config_path('pagseguro.php'),
        ]);
        // check if the App/Http/Requests/LaravelMercadoLivreExists directory exists
        if (!file_exists(app_path('Http/Requests/PagSeguro/'))) {
            mkdir(app_path('Http/Requests/PagSeguro/'), 0755, true);
        }
        $this->publishes([
            __DIR__ . '/app/Http/Requests/' => app_path('Http/Requests/PagSeguro/'),
        ]);

        $this->email = config('pagseguro.email');
        $this->token = config('pagseguro.token');
        $this->host = config('pagseguro.host');
    }
}
