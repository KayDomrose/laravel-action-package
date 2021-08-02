<?php

namespace Kaydomrose\LaravelApiAction\Contracts;

use Illuminate\Http\Request;

interface Action
{
    public function method(): string;
    public function uri(): string;
    public function allow(Request $request): bool;
    public function rules(Request $request): array;
}
