<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/teste', 'Home::teste');
$routes->get("/cadastro", "Usuario::cadastro",['as' => "cadasto_user"]);
