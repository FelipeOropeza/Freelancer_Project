<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailModel;
use App\Models\FreelancerModel;
use App\Models\PropostaFreelancerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Freelancer extends BaseController
{
    private $freelancerModel;
    private $propostafreelancerModel;
    private $emailModel;
    private $db;
    private $emailService;

    public function __construct()
    {
        $this->freelancerModel = new FreelancerModel();
        $this->propostafreelancerModel = new PropostaFreelancerModel();
        $this->emailModel = new EmailModel();
        $this->db = \Config\Database::connect();
        $this->emailService = service('emailNotificacao');
    }

    public function index()
    {
        $idUser = session()->get('usuario')['id'];

        $dadosFreelancer = $this->freelancerModel->getFreelancerComUsuario($idUser);

        return view('freelancer/index', ['dados' => $dadosFreelancer]);
    }

    public function salvarInfo()
    {
        $idUser = session()->get('usuario')['id'];
        $dadosForm = $this->request->getPost();

        $dados = [
            'cpf' => $dadosForm['cpf'],
            'descricao' => $dadosForm['descricao'],
            'especialidades' => $dadosForm['especialidades'],
            'dias_disponiveis' => $dadosForm['dias_disponiveis'],
            'valor_diaria' => $dadosForm['valor_diaria'],
            'telefone' => $dadosForm['telefone'],
            'site' => $dadosForm['site'] ?? null,
            'endereco' => $dadosForm['endereco'],
            'fk_usuarios_id' => $idUser,
        ];

        if ($this->request->getFile('curriculo')->isValid()) {
            $file = $this->request->getFile('curriculo');
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/curriculos', $fileName);
            $dados['curriculo'] = $fileName;
        }

        $this->freelancerModel->where('fk_usuarios_id', $idUser)->set($dados)->update();

        return redirect()->to(route_to('freelancer_perfil'));
    }

    public function visualizarCurriculo($arquivo)
    {
        $caminho = FCPATH . 'uploads/curriculos/' . $arquivo;

        if (!file_exists($caminho)) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }

        $dados = [
            'arquivo' => $arquivo
        ];

        return view('freelancer/ver_curriculo', $dados);
    }

    public function proposta()
    {
        $freelancer = $this->freelancerModel
            ->where('fk_usuarios_id', session()->get('usuario')['id'])
            ->select('id')
            ->first();

        $propostasDetalhadas = $this->propostafreelancerModel
            ->getPropostasDetalhadasByFreelancer($freelancer['id']);

        $dados = [
            'propostas' => $propostasDetalhadas
        ];

        return view('freelancer/proposta', $dados);
    }

    public function aceitarProposta($id)
    {
        $this->db->transStart();

        try {
            $freelancerUsuario = session()->get('usuario');
            $empresaUsuario = $this->propostafreelancerModel->getUsuarioIdByPropostaId($id);

            foreach ([$freelancerUsuario, $empresaUsuario] as $usuario) {
                $this->emailModel->insert([
                    'assunto' => 'Geração de Contrato',
                    'mensagem' => 'O contrato foi gerado com sucesso.',
                    'data_envio' => date('Y-m-d'),
                    'fk_usuarios_id' => $usuario['id']
                ]);
            }

            $this->propostafreelancerModel->aceitarProposta($id);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Erro na transação com o banco de dados.');
            }

            $this->emailService->enviar([
                'email' => $freelancerUsuario['email'],
                'titulo' => 'Proposta aceita!',
                'mensagem' => 'Uma proposta foi aceita e o contrato já está disponível para você.',
                'link_text' => 'Ver contratos',
                'parametro' => $freelancerUsuario['email'],
                'tipo' => 'freelancer',
                'assunto' => 'Contrato gerado',
                'view' => 'emails/contrato'
            ]);

            $this->emailService->enviar([
                'email' => $empresaUsuario['email'],
                'titulo' => 'Olá, tudo certo?',
                'mensagem' => 'Você enviou uma proposta e ela foi aceita.',
                'link_text' => 'Ver contratos',
                'parametro' => $empresaUsuario['email'],
                'tipo' => 'empresa',
                'assunto' => 'Contrato gerado',
                'view' => 'emails/contrato'
            ]);

            return redirect()->to(route_to('freelancer_proposta'))->with('success', 'Proposta aceita com sucesso.');

        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Erro ao aceitar proposta: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao aceitar a proposta. Tente novamente.');
        }
    }


    public function recusarProposta($id)
    {
        $this->propostafreelancerModel->recusarProposta($id);
        return redirect()->to(route_to('freelancer_proposta'))->with('success', 'Proposta recusada com sucesso.');
    }
}
