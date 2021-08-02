<?php

namespace Kaydomrose\LaravelApiAction\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Kaydomrose\LaravelApiAction\Contracts\Action;
use Kaydomrose\LaravelApiAction\Helpers\MethodParameters;

abstract class ActionController extends Controller implements Action
{
    use ValidatesRequests;

    /**
     * Overwrite HTTP status code for response.
     *
     * Default is 200.
     *
     * @return int
     */
    public function responseStatusCode(): int {
        return 200;
    }

    /**
     * Overwrite validation error messages.
     *
     * Default is [].
     *
     * @see https://laravel.com/docs/master/validation#customizing-the-error-messages
     *
     * @return array
     */
    public function validationMessages(): array {
        return [];
    }

    /**
     * Handles action request.
     *
     * DO NOT OVERWRITE THIS.
     *
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function action(Request $request): JsonResponse
    {
        if (!$this->allow($request)) {
            throw new AuthorizationException();
        }

        $this->validate(
            $request,
            $this->rules($request),
            $this->validationMessages()
        );

        $methodParameters = app(MethodParameters::class)->getMethodParameters($this, $request);
        $response = $this->handle(...$methodParameters);

        return response()->json($response, $this->responseStatusCode());
    }
}
