<?php

class Router
{
    private string $controller;
    private string $action;

    public function __construct()
    {
        $explodedUri = explode('/', $this->clearUri($_SERVER['REQUEST_URI']));

        $this->controller = "Controller\\" . ($explodedUri[1] ? ucfirst($explodedUri[1]) : 'Index');
        $this->action = isset($explodedUri[2]) && $explodedUri[2] ? $explodedUri[2] : 'index';
        $this->controller = $this->controller . 'Controller';
        $this->action = $this->action . 'Action';

        if (!$this->controllerExists()) {
            http_response_code(404);
            throw new Exception("Controller '" . $this->controller . "' doesn't exists");
        }

        if (!$this->actionExists()) {
            http_response_code(404);
            throw new Exception("Action '" . $this->action . "' doesn't exists");
        }
    }

    private function clearUri($uri)
    {
        if (false !== $pos = strpos($_SERVER['REQUEST_URI'], '?')) {
            $uri = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }

        return rawurldecode($uri);
    }

    private function controllerExists()
    {
        return class_exists($this->controller);
    }

    private function actionExists()
    {
        return method_exists(new $this->controller, $this->action);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
}