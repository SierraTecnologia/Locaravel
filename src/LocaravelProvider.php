<?php

namespace Locaravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Locaravel\Services\Locaravel;
use Locaravel\Services\LocaravelService;
use Locaravel\Services\InputMaker;
use SierraTecnologia\Crypto\CryptoProvider;
use Igaster\LaravelCities\GeoServiceProvider;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class LocaravelProvider extends ServiceProvider
{

    public static $menuItens = [
        
    ];

    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * Locaravel Routes
         */
        Route::group([
            'namespace' => '\Locaravel\Http\Controllers',
        ], function (/**$router**/) {
            require __DIR__.'/../routes/web.php';
        });
        $this->publishConfigs();
        $this->publishAssets();
        $this->publishMigrations();
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setProviders();

        $this->app->singleton(
            'LocaravelService', function ($app) {
                return new LocaravelService(\Illuminate\Support\Facades\Config::get('sitec-locaravel.models'));
            }
        );

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // View namespace
        $this->loadViewsFrom(__DIR__.'/../resouces/views', 'locaravel');

    }

    protected function loadConfigs()
    {
        
        // Merge own configs into user configs 
        $this->mergeConfigFrom(__DIR__.'/../publishes/config/sitec-locaravel.php', 'sitec-locaravel');
    }

    protected function publishMigrations()
    {
        
       
    }
       
    protected function publishAssets()
    {
        
        // // Publish locaravel css and js to public directory
        // $this->publishes(
        //     [
        //     $this->getDistPath('locaravel') => public_path('assets/locaravel')
        //     ], ['public',  'locaravel', 'locaravel-public']
        // );

    }

    protected function publishConfigs()
    {
        
        // Publish config files
        $this->publishes(
            [
                __DIR__.'/../publishes/config/sitec-locaravel.php' => base_path('config/sitec-locaravel.php'),
            ], ['config',  'locaravel', 'locaravel-config']
        );

    }

    protected function setProviders()
    {
        $this->app->register(GeoServiceProvider::class);
        $this->app->register(CryptoProvider::class);

    }
}
