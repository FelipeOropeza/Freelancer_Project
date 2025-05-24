<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Empresa extends BaseController
{
    public function index()
    {
        return view('empresa/index');
    }
}
