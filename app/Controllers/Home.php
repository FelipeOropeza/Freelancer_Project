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
        return view('index');
    }

    public function lista(): string
    {
        $freelancers = $this->freelancerModel->getFreelancersWithUser();

        return view('listafreela', [
            'freelancers' => $freelancers,
            'pager' => $this->freelancerModel->pager,
            'totalFreela' => $this->freelancerModel->countAll(),
        ]);
    }

}
