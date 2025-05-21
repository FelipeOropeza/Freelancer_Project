<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\FreelancerModel;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    private $usuarioModel;
    private $empresaModel;
    private $freelancerModel;
    private $db;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->empresaModel = new EmpresaModel();
        $this->freelancerModel = new FreelancerModel();
        $this->db = \Config\Database::connect();
    }

    public function cadastro()
    {
        return view('cadastro');
    }

    public function criarUsuario()
    {
        $dadosForm = $this->request->getPost();

        $this->db->transBegin();

        try {
            if (!empty($dadosForm['cpf'])) {
                $dadosForm['cpf'] = str_replace(['.', '-'], '', $dadosForm['cpf']);
                $dadosForm['tipo'] = 'freelancer';
                $id = $this->usuarioModel->insert($dadosForm);

                if ($id === false) {
                    throw new \Exception('Erro ao inserir usuário freelancer.');
                }

                $dadosFreelancer = [
                    'cpf' => $dadosForm['cpf'],
                    'fk_usuarios_id' => $id,
                ];

                if (!$this->freelancerModel->insert($dadosFreelancer)) {
                    throw new \Exception('Erro ao inserir dados do freelancer.');
                }

            } else {
                $dadosForm['cnpj'] = str_replace(['.', '-', '/'], '', $dadosForm['cnpj']);
                $dadosForm['tipo'] = 'empresa';
                $id = $this->usuarioModel->insert($dadosForm);

                if ($id === false) {
                    throw new \Exception('Erro ao inserir usuário empresa.');
                }

                $dadosEmpresa = [
                    'cnpj' => $dadosForm['cnpj'],
                    'fk_usuarios_id' => $id,
                ];

                if (!$this->empresaModel->insert($dadosEmpresa)) {
                    throw new \Exception('Erro ao inserir dados da empresa.');
                }
            }

            $this->db->transCommit();
            return redirect()->to('/login')->with('success', 'Pra completar o cadastro verifique o seu e-mail!');

        } catch (\Exception $e) {
            $this->db->transRollback();

            echo 'Erro: ' . $e->getMessage();
            // return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function login()
    {
        return view('login');
    }

    public function autenticar()
    {
        $dadosForm = $this->request->getPost();

        $usuario = $this->usuarioModel->where('email', $dadosForm['email'])->first();

        if (!$usuario || !password_verify($dadosForm['senha'], $usuario['senha'])) {
            return redirect()->back()->withInput()->with('validation', 'E-mail ou senha inválidos.');
            ;
        }

        unset($usuario['senha']);

        // var_dump($usuario);
        session()->set('usuario', $usuario);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('sucesso', 'Sessão encerrada.');
    }
}
