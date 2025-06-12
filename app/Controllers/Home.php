<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\FreelancerModel;
use App\Models\PropostaModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    private $freelancerModel;
    private $propostaModel;
    private $empresaModel;

    public function __construct()
    {
        $this->freelancerModel = new FreelancerModel();
        $this->empresaModel = new EmpresaModel;
        $this->propostaModel = new PropostaModel();
    }

    public function index(): string
    {
        return view('home/index');
    }

    public function lista(): string
    {
        $usuarioData = session()->get('usuario');

        $usuario = $usuarioData['tipo'] ?? null;
        $usuarioId = $usuarioData['id'] ?? null;

        $propostasEmpresa = [];

        if ($usuario === 'empresa' && $usuarioId) {
            $empresa = $this->empresaModel
                ->where('fk_usuarios_id', $usuarioId)
                ->first();

            if ($empresa) {
                $propostasEmpresa = $this->propostaModel
                    ->where('fk_empresas_id', $empresa['id'])
                    ->findAll();
            }
        }

        $filtros = [
            'categoria' => $this->request->getGet('categoria'),
            'valor_min' => $this->request->getGet('valor_min'),
            'valor_max' => $this->request->getGet('valor_max'),
            'dias' => $this->request->getGet('dias'),
        ];

        $freelancers = $this->freelancerModel->getFreelancersWithUserFiltered($filtros);

        foreach ($freelancers as &$freelancer) {
            $freelancer['nome'] = ucwords(strtolower($freelancer['nome']));

            $especialidades = $freelancer['especialidades'] ?? 'Não informado';
            $especialidadesArray = array_map('trim', explode(',', $especialidades));
            $primeira = $especialidadesArray[0] ?? 'Não informado';
            $freelancer['especialidade_formatada'] = (count($especialidadesArray) > 1)
                ? $primeira . '...'
                : $primeira;
        }

        $totalFreela = $this->freelancerModel->countFiltered($filtros);

        return view('home/listafreela', [
            'usuario' => $usuario,
            'propostasEmpresa' => $propostasEmpresa,
            'freelancers' => $freelancers,
            'pager' => $this->freelancerModel->pager,
            'totalFreela' => $totalFreela,
            'valorMin' => $filtros['valor_min'],
            'valorMax' => $filtros['valor_max'],
            'diasSelecionados' => $filtros['dias'] ?? [],
            'categoriaSelecionada' => $filtros['categoria'] ?? '',
        ]);
    }
}
