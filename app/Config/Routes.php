<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('/', 'Pages::index');
    $routes->get('nilai/(:segment)', 'MahasiswaController::getMahasiswaInfo/$1');
});
