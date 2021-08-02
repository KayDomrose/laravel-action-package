<?php

namespace Kaydomrose\LaravelApiAction\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LaravelApiAction
 * @package Kaydomrose\LaravelApiAction\Facades
 *
 * @method static void routes(array $actions)
 */
class LaravelApiAction extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-api-action';
    }
}
