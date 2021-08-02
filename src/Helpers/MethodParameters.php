<?php


namespace Kaydomrose\LaravelApiAction\Helpers;


use Illuminate\Http\Request;
use Kaydomrose\LaravelApiAction\Controllers\ActionController;
use ReflectionClass;
use ReflectionException;

class MethodParameters
{

    /**
     * Get method parameters for route model binding and dependency injection.
     *
     * @param ActionController $controller
     * @param Request $request
     * @return array
     * @throws ReflectionException
     */
    public function getMethodParameters(ActionController $controller, Request $request): array
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
