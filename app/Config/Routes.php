<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/lista', 'Home::lista');
$routes->get("/cadastro", "Usuario::cadastro", ['as' => "cadasto_user"]);
$routes->post("/cadastro", "Usuario::criarUsuario", ['as' => "criar_user"]);
$routes->get("/login", "Usuario::login", ['as' => "login_user"]);
$routes->post("/login", "Usuario::autenticar", ['as' => "autenticar_user"]);
$routes->get('/contrato/visualizar/(:any)', 'Usuario::visualizarContrato/$1', ['as' => 'ver_contrato']);

$routes->get('/valida/email', 'Usuario::validaEmail', ['as' => 'valida_email']);
$routes->get("/logout", "Usuario::logout", ['as' => "logout_user"]);

$routes->get('/perfil-empresa', 'Empresa::index', ['as' => 'empresa_perfil']);
$routes->post('/perfil-empresa/salvar', 'Empresa::salvarInfo', ['as' => 'empresa_info']);
$routes->get('/proposta-empresa', 'Empresa::proposta', ['as' => 'empresa_proposta']);
$routes->post('/proposta-empresa/salvar', 'Empresa::salvarProposta', ['as' => 'empresa_proposta_salvar']);
$routes->post('/enviar-proposta', 'Empresa::enviarProposta', ['as' => 'enviar-proposta']);
$routes->get('/contrato-empresa', 'Empresa::contrato', options: ['as' => 'empresa_contrato']);
$routes->post('/contrato-empresa/assinar', 'Empresa::assinarContrato', ['as' => 'assinar_contrato_empresa']);

$routes->get('/perfil-freelancer', 'Freelancer::index', ['as' => 'freelancer_perfil']);
$routes->post('/perfil-freelancer/salvar', 'Freelancer::salvarInfo', ['as' => 'freelancer_info']);
$routes->get('/perfil-freelancer/curriculo/(:any)', 'Freelancer::visualizarCurriculo/$1', ['as' => 'ver_curriculo']);
$routes->get('/proposta-freelancer', 'Freelancer::proposta', ['as' => 'freelancer_proposta']);
$routes->post('/proposta-freelancer/aceitar/(:num)', 'Freelancer::aceitarProposta/$1', ['as' => 'proposta_aceitar']);
$routes->post('/proposta-freelancer/recusar/(:num)', 'Freelancer::recusarProposta/$1', ['as' => 'proposta_recusar']);
$routes->get('/contrato-freelancer', 'Freelancer::contrato', ['as' => 'freelancer_contrato']);
$routes->post('/contrato-freelancer/assinar', 'Freelancer::assinarContrato', ['as' => 'assinar_contrato_freelancer']);