<?php

class Route
{
    private $controller;
    private $method;
    private $urlParts;

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
        $this->urlParts = explode('/', $url);

        $this->controller = $routes['default_controller'];
        $this->method = $routes['default_method'];

        if (!isset($_SESSION['user'])) {
            if ($this->urlParts[1] !== 'login' && $this->urlParts[1] !== 'registration') {
                header('Location:' . BASE_URL . 'login');
            }
        }

        if (!empty($this->urlParts[1])) {
            $this->controller = ucfirst($this->urlParts[1]) . 'Controller';
            if (!empty($this->urlParts[2])) {
                $this->method = $this->urlParts[2];
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
            if (isset($this->urlParts[3])) {
                call_user_func([$this->controller, $this->method], $this->urlParts[3]);
            } else {
                call_user_func([$this->controller, $this->method]);
            }
        } else {
            die('Method not found.');
        }
    }
}