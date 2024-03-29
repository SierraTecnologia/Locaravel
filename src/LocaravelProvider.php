<?php

namespace Locaravel;

use Bosnadev\Database\DatabaseServiceProvider as PostgresDatabaseServiceProvider;
// use Igaster\LaravelCities\GeoServiceProvider;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Locaravel\Connectors\ConnectionFactory;
use Locaravel\Services\InputMaker;
use Locaravel\Services\Locaravel;
use Locaravel\Services\LocaravelService;
use Muleta\Traits\Providers\ConsoleTools;
use SierraTecnologia\Crypto\CryptoProvider;

class LocaravelProvider extends ServiceProvider
{

    use ConsoleTools;
    
    public $packageName = 'locaravel';
    const pathVendor = 'sierratecnologia/locaravel';


    public static $providers = [

        \Translation\TranslationServiceProvider::class,

        
    ];

    public static $menuItens = [
        // Igual em: Locaravel, Bancario, Telefonica, Informate, Population
        [
            'text' => 'Universo',
            'icon' => 'fas fa-fw fa-globe-americas',
            'icon_color' => "blue",
            'label_color' => "success",
            'order' => 2800,
            'section' => "admin",
            // 'feature' => 'bancario',
            'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
            'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
        ],
        'Universo' => [
            [
                'text' => 'Cadastros',
                'icon' => 'fas fa-fw fa-search',
                'icon_color' => "blue",
                'label_color' => "success",
                'section'   => 'admin',
                'feature' => 'locaravel',
                'order' => 3400,
                'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
            ],
            'Cadastros' => [
                [
                    'text'        => 'Endereços',
                    'route'       => 'admin.locaravel.addresses.index',
                    'icon'        => 'fas fa-fw fa-gavel',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'   => 'admin',
                    'feature' => 'locaravel',
                    'order' => 3400,
                    'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                    'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Places',
                    'route'       => 'admin.locaravel.places.index',
                    'icon'        => 'fas fa-fw fa-gavel',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'   => 'admin',
                    // 'feature' => 'locaravel',
                    'order' => 3400,
                    'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                    'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
            ],
        ],
    ];

    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Register configs, migrations, etc
        $this->registerDirectories();

        // COloquei no register pq nao tava reconhecendo as rotas para o adminlte
        $this->app->booted(
            function () {
                $this->routes();
            }
        );
    }


    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        /**
         * Stalker Routes
         */
        $this->loadRoutesForRiCa(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'routes');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'LocaravelService',
            function ($app) {
                return new LocaravelService();
            }
        );

        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');

        $this->app->singleton(
            'locaravel',
            function () {
                return new LocaravelService();
            }
        );
        // $this->app->booted(function () {
        //     $this->routes();
        // });

        // The connection factory is used to create the actual connection instances on
        // the database. We will inject the factory into the manager so that it may
        // make the connections while they are actually needed and not of before.
        $this->app->singleton(
            'db.factory',
            function ($app) {
                return new ConnectionFactory($app);
            }
        );

        // The database manager is used to resolve various connections, since multiple
        // connections might be managed. It also implements the connection resolver
        // interface which may be used by other components requiring connections.
        $this->app->singleton(
            'db',
            function ($app) {
                return new DatabaseManager($app, $app['db.factory']);
            }
        );

        $this->setProviders();
    }

    protected function loadConfigs(): void
    {
        
        // Merge own configs into user configs
        $this->mergeConfigFrom(__DIR__.'/../publishes/config/sitec-locaravel.php', 'sitec-locaravel');
    }

    protected function publishMigrations(): void
    {
    }
       
    protected function publishAssets(): void
    {
        
        // // Publish locaravel css and js to public directory
        // $this->publishes(
        //     [
        //     $this->getDistPath('locaravel') => public_path('assets/locaravel')
        //     ], ['public',  'locaravel', 'locaravel-public']
        // );
    }

    protected function publishConfigs(): void
    {
        
        // Publish config files
        $this->publishes(
            [
                __DIR__.'/../publishes/config/sitec-locaravel.php' => base_path('config/sitec-locaravel.php'),
            ],
            ['config',  'locaravel', 'locaravel-config']
        );
    }

    protected function setProviders(): void
    {
        // @todo
        // $this->app->register(GeoServiceProvider::class);
        $this->app->register(CryptoProvider::class);
    }
    /**
     * Register configs, migrations, etc
     *
     * @return void
     */
    public function registerDirectories()
    {
        $this->publishConfigs();
        $this->publishAssets();
        $this->publishMigrations();

        // // Publish locaravel css and js to public directory
        // $this->publishes([
        //     $this->getDistPath('locaravel') => public_path('assets/locaravel')
        // ], ['public',  'sitec', 'sitec-public']);

        $this->loadViews();
        $this->loadTranslations();


        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
    }

    private function loadViews(): void
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'locaravel');
        $this->publishes(
            [
            $viewsPath => base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'locaravel'),
            ],
            ['views',  'sitec', 'sitec-views', 'locaravel']
        );
    }
    
    private function loadTranslations(): void
    {
        // Publish lanaguage files
        $this->publishes(
            [
            $this->getResourcesPath('lang') => resource_path('lang'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'locaravel')
            ],
            ['lang',  'sitec', 'locaravel']
        );

        // Load locaravel
        $this->loadTranslationsFrom($this->getResourcesPath('lang'), 'locaravel');
    }
}
