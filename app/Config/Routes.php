<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/lista', 'Home::lista');
$routes->get("/cadastro", "Usuario::cadastro",['as' => "cadasto_user"]);
$routes->post("/cadastro", "Usuario::criarUsuario",['as' => "criar_user"]);
$routes->get('/valida/email', 'Usuario::validaEmail', ['as' => 'valida_email']);
$routes->get("/login", "Usuario::login",['as' => "login_user"]);
$routes->get("/logout", "Usuario::logout",['as' => "logout_user"]);
$routes->post("/login", "Usuario::autenticar",['as' => "autenticar_user"]);


$routes->get('/perfil-empresa', 'Empresa::index', ['as' => 'empresa_perfil']);
