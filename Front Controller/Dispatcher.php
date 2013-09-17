<?php

namespace FrontController;

class Dispatcher
{
    public function dispatch($route, $request, $response)
    {
        $controller = $route->createController();
        $controller->execute($request, $response);
    }
}