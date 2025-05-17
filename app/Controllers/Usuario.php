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

        if (!empty($dadosForm['cpf'])) {
            $dadosForm['tipo'] = 'freelancer';
        } else {
            $dadosForm['tipo'] = 'empresa';
        }

        $this->usuarioModel->insert($dadosForm);

        return redirect()->to('/login');
    }


    public function login()
    {
        return view('login');
    }
}
