<?php

namespace Kaydomrose\LaravelApiAction\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateAction extends GeneratorCommand
{
    protected $signature = 'make:action {name}';

    protected $description = 'Create a new action.';

    protected $help = 'Create action from boilerplate.';

    protected $type = 'Action';

    protected function getStub(): string
    {
        return  __DIR__ . '/../stubs/Action.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}/Http/Actions";
    }
}
