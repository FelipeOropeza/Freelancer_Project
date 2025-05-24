<?php

namespace App\Controllers;

use App\Models\FreelancerModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    private $freelancerModel;
    private $usuarioModel;

    public function __construct()
    {
        $this->freelancerModel = new FreelancerModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index(): string
    {
        return view('home/index');
    }

    public function lista(): string
    {
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
