<?php

namespace App\Controllers;

use App\Models\EmailModel;
use App\Models\EmpresaModel;
use App\Models\FreelancerModel;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    private $usuarioModel;
    private $empresaModel;
    private $freelancerModel;
    private $emailModel;
    private $db;
    private $emailService;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->empresaModel = new EmpresaModel();
        $this->freelancerModel = new FreelancerModel();
        $this->emailModel = new EmailModel();
        $this->db = \Config\Database::connect();
        $this->emailService = service('emailNotificacao');
    }

    public function cadastro()
    {
        return view('usuario/cadastro');
    }

    public function criarUsuario()
    {
        $dadosForm = $this->request->getPost();

        $this->db->transBegin();

        try {
            if (!empty($dadosForm['cpf'])) {
                $dadosForm['cpf'] = str_replace(['.', '-'], '', $dadosForm['cpf']);
                $dadosForm['tipo'] = 'freelancer';
                $dadosForm['data_criacao'] = date('Y-m-d');
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
                $dadosForm['data_criacao'] = date('Y-m-d');
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

            $this->emailModel->insert([
                'assunto' => 'Verificação Email',
                'mensagem' => 'É preciso verificar o email pra entrar no website',
                'data_envio' => date('Y-m-d'),
                'fk_usuarios_id' => $id
            ]);

            $this->db->transCommit();

            $this->emailService->enviar([
                'email' => $dadosForm['email'],
                'titulo' => 'Bem-vindo ao Job Finder',
                'mensagem' => 'Para completar o cadastro, por favor, verifique seu e-mail.',
                'link_text' => 'Validar e-mail',
                'parametro' => $dadosForm['email'],
                'tipo' => $dadosForm['tipo'],
                'assunto' => 'Verificação de E-mail',
                'view' => 'emails/validaEmail'
            ]);

            return redirect()->to('/login')->with('success', 'Pra completar o cadastro verifique o seu e-mail!');

        } catch (\Exception $e) {
            $this->db->transRollback();

            echo 'Erro: ' . $e->getMessage();
            // return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function validaEmail()
    {
        $email = $this->request->getGet('email');

        $usuario = $this->usuarioModel->where('email', $email)->first();

        $this->usuarioModel->update($usuario['id'], [
            'email_valido' => 1
        ]);

        return redirect()->to('/login')->with('success', 'Seu email foi verificado com sucesso!');
    }

    public function login()
    {
        return view('usuario/login');
    }

    public function autenticar()
    {
        $dadosForm = $this->request->getPost();

        $usuario = $this->usuarioModel->where('email', $dadosForm['email'])->first();

        if ($usuario['email_valido'] == 0) {
            return redirect()->back()->withInput()->with('validation', 'E-mail não foi validado');
        }

        if (!$usuario || !password_verify($dadosForm['senha'], $usuario['senha'])) {
            return redirect()->back()->withInput()->with('validation', 'E-mail ou senha inválidos.');
        }

        unset($usuario['senha']);

        session()->set('usuario', $usuario);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('sucesso', 'Sessão encerrada.');
    }


    public function visualizarContrato($arquivo)
    {
        $caminho = FCPATH . 'uploads/contratos/' . $arquivo;

        if (!file_exists($caminho)) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }

        $dados = [
            'arquivo' => $arquivo
        ];

        return view('usuario/ver_contrato', $dados);
    }
}
