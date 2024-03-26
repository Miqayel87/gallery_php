<?php
session_start();

require_once 'configs/config.php';
require_once 'route.php';

$routes = [
    'default_controller' => 'AdminController',
    'default_method' => 'index'
];

$url = new Route($routes);
