<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailModel;
use App\Models\EmpresaModel;
use App\Models\PropostaFreelancerModel;
use App\Models\PropostaModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Empresa extends BaseController
{
    private $empresaModel;
    private $db;
    private $usuarioModel;
    private $propostaModel;
    private $propostafreelancerModel;
    private $email;
    private $emailModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->db = \Config\Database::connect();
        $this->usuarioModel = new UsuarioModel();
        $this->propostaModel = new PropostaModel();
        $this->propostafreelancerModel = new PropostaFreelancerModel();
        $this->emailModel = new EmailModel();
        $this->email = service('email');
    }

    public function index()
    {
        $idUser = session()->get('usuario')['id'];

        $dadosEmpresa = $this->empresaModel->getEmpresaComUsuario($idUser);

        return view('empresa/index', ['dados' => $dadosEmpresa]);
    }

    public function salvarInfo()
    {
        $dadosForm = $this->request->getPost();

        $usuarioId = session()->get('usuario')['id'];

        $this->db->transBegin();

        try {
            $dadosUsuario = [
                'nome' => $dadosForm['nome'],
            ];

            $this->usuarioModel->update($usuarioId, $dadosUsuario);

            $session = session();
            $sessionData = $session->get('usuario');
            $sessionData['nome'] = $dadosForm['nome'];
            $session->set('usuario', $sessionData);

            $dadosEmpresa = [
                'descricao' => $dadosForm['descricao'],
                'telefone' => $dadosForm['telefone'],
                'site' => $dadosForm['site'],
                'endereco' => $dadosForm['endereco']
            ];

            $this->empresaModel->where('fk_usuarios_id', $usuarioId)
                ->set($dadosEmpresa)
                ->update();

            if ($this->db->transStatus() === FALSE) {
                $this->db->transRollback();
                return redirect()->back()->with('erro', 'Erro ao atualizar informações.');
            } else {
                $this->db->transCommit();
                return redirect()->back()->with('sucesso', 'Informações atualizadas com sucesso!');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('erro', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    public function proposta()
    {
        $empresa = $this->empresaModel
            ->where('fk_usuarios_id', session()->get('usuario')['id'])
            ->select('id')
            ->first();

        $empresaId = $empresa['id'] ?? null;

        if (!$empresaId) {
            return redirect()->back()->with('erro', 'Empresa não encontrada!');
        }

        $propostas = $this->propostaModel
            ->where('fk_empresas_id', $empresaId)
            ->findAll();

        return view('empresa/proposta', [
            'propostas' => $propostas
        ]);
    }

    public function salvarProposta()
    {
        $dadosForm = $this->request->getPost();

        $empresa = $this->empresaModel
            ->where('fk_usuarios_id', session()->get('usuario')['id'])
            ->select('id')
            ->first();

        $empresaId = $empresa['id'] ?? null;

        if (!$empresaId) {
            return redirect()->back()->with('erro', 'Empresa não encontrada!');
        }

        $this->propostaModel->insert([
            'descricao' => $dadosForm['descricao'],
            'valor' => $dadosForm['valor'],
            'tipo' => $dadosForm['tipo'],
            'endereco' => $dadosForm['endereco'],
            'fk_empresas_id' => $empresaId
        ]);

        return redirect()->back()->with('sucesso', 'Proposta criada com sucesso!');
    }

    public function enviarProposta()
    {
        $dadosForm = $this->request->getPost();

        $this->db->transBegin();

        try {
            $this->propostafreelancerModel->insert([
                'fk_propostas_id' => $dadosForm['proposta_id'],
                'fk_freelancers_id' => $dadosForm['freelancer_id']
            ]);

            $usuario = $this->usuarioModel->getUsuarioInfoByFreelancerId($dadosForm['freelancer_id']);

            $usuarioId = $usuario['id'];
            $email = $usuario['email'];

            $this->emailModel->insert([
                'assunto' => 'Envio de Proposta',
                'mensagem' => 'Uma empresa envio uma proposta',
                'data_envio' => date('Y-m-d'),
                'fk_usuarios_id' => $usuarioId
            ]);

            $dados = [
                'titulo' => 'Olá, tudo certo?',
                'mensagem' => 'Uma empresa acabou de enviar uma proposta pra você.',
                'link_text' => 'Ver propostas',
                'parametro' => $email
            ];

            $mensagem = view('emails/proposta', $dados);

            $this->email->setFrom('felipe2006.co@gmail.com', 'Job Flnder');
            $this->email->setTo($email);
            $this->email->setSubject('Proposta');
            $this->email->setMessage($mensagem);

            if (!$this->email->send()) {
                throw new \Exception('Erro ao enviar o email.');
            }

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('erro', 'Erro ao enviar proposta.');
            }

            $this->db->transCommit();
            return redirect()->back()->with('sucesso', 'Proposta enviada com sucesso!');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('erro', 'Erro: ' . $e->getMessage());
        }
    }
}
