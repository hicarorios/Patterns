<?php

namespace FrontController;

class FrontController
{
    public function __construct($router, $dispatcher)
    {
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    public function run(RequestInterface $request, ResponseInterface $response)
    {
        $route = $this->router->route($request, $response);
        $this->dispatcher->dispatch($route, $request, $response);
    }
}

/*
    $request = new Request("http://example.com/test/");

    $response = new Response;

    $route1 = new Route("http://example.com/test/", "Acme\\Library\\Controller\\TestController");

    $route2 = new Route("http://example.com/error/", "Acme\\Library\\Controller\\ErrorController");

    $router = new Router(array($route1, $route2));

    $dispatcher = new Dispatcher;

    $frontController = new FrontController($router, $dispatcher);

    $frontController->run($request, $response);
*/