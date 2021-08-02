<?php

namespace Kaydomrose\LaravelApiAction;

use Illuminate\Support\ServiceProvider;

class LaravelApiActionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kaydomrose');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kaydomrose');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-api-action.php', 'laravel-api-action');

        // Register the service the package provides.
        $this->app->singleton('laravel-api-action', function ($app) {
            return new LaravelApiAction;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-api-action'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
//        $this->publishes([
//            __DIR__.'/../config/laravel-api-action.php' => config_path('laravel-api-action.php'),
//        ], 'laravel-api-action.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kaydomrose'),
        ], 'laravel-api-action.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kaydomrose'),
        ], 'laravel-api-action.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kaydomrose'),
        ], 'laravel-api-action.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
