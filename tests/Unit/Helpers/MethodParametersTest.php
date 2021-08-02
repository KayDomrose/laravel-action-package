<?php

namespace Tests\Unit\Helpers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Kaydomrose\LaravelApiAction\Helpers\MethodParameters;
use PHPUnit\Framework\TestCase;

class MethodParametersTest extends TestCase
{
    public function test_works_without_any_args()
    {
        $controller = new WithoutArgs();
        $request = new Request();
        $helper = new MethodParameters();

        $result = $helper->getMethodParameters($controller, $request);

        $this->assertEmpty($result);
    }

    public function test_works_with_dependency_injection()
    {
        $controller = new WithDependencyInjection();
        $request = new Request();
        $helper = new MethodParameters();

        $result = $helper->getMethodParameters($controller, $request);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(App::class, $result[0]);
    }

    public function test_works_with_route_model_binding()
    {
        $this->markTestSkipped('Figure out how to test without laravel model.');
    }
}

class WithoutArgs extends Controller {
    public function handle() {}
}

class WithDependencyInjection extends Controller  {
    public function handle(App $app) {}
}
