<?php
use Cake\Routing\Router;

Router::plugin('Cake3Kendo', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
