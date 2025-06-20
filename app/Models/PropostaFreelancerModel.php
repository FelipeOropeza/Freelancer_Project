<?php

namespace App\Models;

use CodeIgniter\Model;

class PropostaFreelancerModel extends Model
{
    protected $table = 'proposta_freelancer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['fk_propostas_id', 'fk_freelancers_id', 'status'];

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

    public function getPropostasDetalhadasByFreelancer($freelancerId)
    {
        return $this->select('propostas.titulo, propostas.descricao, propostas.endereco, propostas.data_inicio, propostas.data_conclusao, propostas.tipo, propostas.valor, proposta_freelancer.status, proposta_freelancer.id')
            ->join('propostas', 'propostas.id = proposta_freelancer.fk_propostas_id')
            ->where('proposta_freelancer.fk_freelancers_id', $freelancerId)
            ->findAll();
    }

    public function getUsuarioIdByPropostaId($id)
    {
        return $this->select('usuarios.id, usuarios.email')
            ->join('propostas', 'propostas.id = proposta_freelancer.fk_propostas_id')
            ->join('empresas', 'empresas.id = propostas.fk_empresas_id')
            ->join('usuarios', 'usuarios.id = empresas.fk_usuarios_id')
            ->where('proposta_freelancer.id', $id)
            ->get()
            ->getRowArray();
    }

    public function aceitarProposta($id)
    {
        return $this->update($id, ['status' => 'aceita']);
    }

    public function recusarProposta($id)
    {
        return $this->update($id, ['status' => 'recusada']);
    }
}
