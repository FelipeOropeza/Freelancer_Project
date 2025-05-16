<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function cadastro()
    {
        return view('cadastro');
    }

    public function criarUsuario()
    {
        $dadosForm = $this->request->getPost();

        $this->usuarioModel->insert($dadosForm);
    }
}
