<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/lista', 'Home::lista');
$routes->get("/cadastro", "Usuario::cadastro",['as' => "cadasto_user"]);
$routes->post("/cadastro", "Usuario::criarUsuario",['as' => "criar_user"]);
$routes->get("/login", "Usuario::login",['as' => "login_user"]);
$routes->post("/login", "Usuario::autenticar",['as' => "autenticar_user"]);

$routes->get('/valida/email', 'Usuario::validaEmail', ['as' => 'valida_email']);
$routes->get("/logout", "Usuario::logout",['as' => "logout_user"]);

$routes->get('/perfil-empresa', 'Empresa::index', ['as' => 'empresa_perfil']);
$routes->post('/perfil-empresa/salvar', 'Empresa::salvarInfo', ['as' => 'empresa_info']);
$routes->get('/proposta-empresa', 'Empresa::proposta', ['as' => 'empresa_proposta']);
$routes->post('/proposta-empresa/salvar', 'Empresa::salvarProposta', ['as' => 'empresa_proposta_salvar']);
$routes->post('/enviar-proposta', 'Empresa::enviarProposta', ['as' => 'enviar-proposta']);
