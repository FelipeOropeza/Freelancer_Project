<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/teste', 'Home::teste');
$routes->get("/cadastro", "Usuario::cadastro",['as' => "cadasto_user"]);
$routes->post("/cadastro", "Usuario::criarUsuario",['as' => "criar_user"]);
$routes->get("/login", "Usuario::login",['as' => "login_user"]);

