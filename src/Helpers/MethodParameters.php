<?php

namespace Kaydomrose\LaravelApiAction\Helpers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReflectionClass;
use ReflectionException;

class MethodParameters
{
    /**
     * Get method parameters for route model binding and dependency injection.
     *
     * @param Controller $controller
     * @param Request $request
     * @return array
     * @throws ReflectionException
     */
    public function getMethodParameters(Controller $controller, Request $request): array
    {
        $reflector = new ReflectionClass($controller);
        $methodParameters = [];
        foreach ($reflector->getMethod('handle')->getParameters() as $handleParameters) {
            $parameterName = $handleParameters->getName();

            $container = app($handleParameters->getType()->getName());
            if ($input = $request->route($parameterName)) {
                $container = $container->resolveRouteBinding($input);
            }
            $methodParameters[] = $container;
        }
        return $methodParameters;
    }
}
