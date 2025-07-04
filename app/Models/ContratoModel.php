<?php

namespace App\Models;

use CodeIgniter\Model;

class ContratoModel extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['assinatura_freelancer', 'assinatura_empresa', 'contrato', 'fk_proposta_freelancer_id', 'fk_empresa_id', 'fk_freelancer_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getContratosComFreelancers(int $empresaId): array
    {
        return $this->select('contratos.*, usuarios.nome AS nome_freelancer')
            ->join('freelancers', 'freelancers.id = contratos.fk_freelancer_id')
            ->join('usuarios', 'usuarios.id = freelancers.fk_usuarios_id')
            ->where('contratos.fk_empresa_id', $empresaId)
            ->findAll();
    }

    public function getContratosComEmpresas(int $freelancerId): array
    {
        return $this->select('contratos.*, usuarios.nome AS nome_empresa')
            ->join('empresas', 'empresas.id = contratos.fk_empresa_id')
            ->join('usuarios', 'usuarios.id = empresas.fk_usuarios_id') // CORRETO AQUI
            ->where('contratos.fk_freelancer_id', $freelancerId)
            ->findAll();
    }
}
