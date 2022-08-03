<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
});
Router::scope('/api', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    $routes->resources('Calendar');
    $routes->resources('Todo');
});
