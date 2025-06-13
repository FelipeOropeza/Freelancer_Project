<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FreelancerModel;
use App\Models\PropostaFreelancerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Freelancer extends BaseController
{
    private $freelancerModel;
    private $propostafreelancerModel;
    public function __construct()
    {
        $this->freelancerModel = new FreelancerModel();
        $this->propostafreelancerModel = new PropostaFreelancerModel();
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
}
