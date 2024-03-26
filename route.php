<?php

class Route
{
    private $controller;
    private $method;

    public function __construct($routes)
    {
        $this->parseUrl($routes);
        $this->loadController();
        $this->callMethod();
    }

    private function parseUrl($routes)
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = parse_url($url, PHP_URL_PATH);
        $url = trim($url, '/');
        $urlParts = explode('/', $url);

        $this->controller = $routes['default_controller'];
        $this->method = $routes['default_method'];

        if ($urlParts[0] !== 'auth' && !$_SESSION['user']) {
            header('Location:' . BASE_URL . 'auth/index');
        }

        if (!empty($urlParts[0])) {
            $this->controller = ucfirst($urlParts[0]) . 'Controller';
            if (!empty($urlParts[1])) {
                $this->method = $urlParts[1];
            }
        }
    }

    private function loadController()
    {
        $controllerFile = 'controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller;
            } else {
                die('404');
            }
        } else {
            die('404');
        }
    }

    private function callMethod()
    {
        if (method_exists($this->controller, $this->method)) {
            call_user_func([$this->controller, $this->method]);
        } else {
            die('Method not found.');
        }
    }
}