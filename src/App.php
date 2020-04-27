<?php

class App
{
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $controller = $this->router->getController();
        $action = $this->router->getAction();

        (new $controller())->$action();
    }
}