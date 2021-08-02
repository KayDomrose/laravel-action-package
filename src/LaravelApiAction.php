<?php

namespace Kaydomrose\LaravelApiAction;

use Illuminate\Support\Facades\Route;

class LaravelApiAction
{
    /**
     * Register action routes.
     *
     * @param string[] $actions List of action classes.
     */
    public function routes(array $actions): void {
        foreach ($actions as $action) {
            $instance = new $action;

            Route::match(
                $instance->method(),
                $instance->uri(),
                [$action, 'action']
            );
        }
    }
}
