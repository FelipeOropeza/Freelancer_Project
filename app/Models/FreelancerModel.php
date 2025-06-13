<?php

namespace App\Models;

use CodeIgniter\Model;

class FreelancerModel extends Model
{
    protected $table = 'freelancers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['cpf', 'descricao', 'especialidades', 'dias_disponiveis', 'valor_diaria', 'telefone', 'site', 'endereco', 'curriculo', 'fk_usuarios_id'];

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

    public function getFreelancersWithUserFiltered(array $filtros = [], int $itensPorPagina = 10)
    {
        $builder = $this->select('freelancers.*, usuarios.nome, usuarios.email')
            ->join('usuarios', 'usuarios.id = freelancers.fk_usuarios_id');

        if (!empty($filtros['categoria'])) {
            $builder->like('freelancers.especialidades', $filtros['categoria']);
        }

        if (isset($filtros['valor_min']) && $filtros['valor_min'] !== '') {
            $builder->where('freelancers.valor_diaria >=', (float) $filtros['valor_min']);
        }

        if (isset($filtros['valor_max']) && $filtros['valor_max'] !== '') {
            $builder->where('freelancers.valor_diaria <=', (float) $filtros['valor_max']);
        }

        if (!empty($filtros['dias']) && is_array($filtros['dias'])) {
            foreach ($filtros['dias'] as $dia) {
                $builder->like('freelancers.dias_disponiveis', $dia);
            }
        }

        return $builder->paginate($itensPorPagina, 'freelancers');
    }

    public function countFiltered($filtros)
    {
        $query = $this->select('freelancers.id')
            ->join('usuarios', 'usuarios.id = freelancers.fk_usuarios_id');

        if (!empty($filtros['categoria'])) {
            $query->like('freelancers.especialidades', $filtros['categoria']);
        }

        if (!empty($filtros['valor_min'])) {
            $query->where('freelancers.valor_diaria >=', $filtros['valor_min']);
        }

        if (!empty($filtros['valor_max'])) {
            $query->where('freelancers.valor_diaria <=', $filtros['valor_max']);
        }

        if (!empty($filtros['dias']) && is_array($filtros['dias'])) {
            foreach ($filtros['dias'] as $dia) {
                $query->like('freelancers.dias_disponiveis', $dia);
            }
        }

        return $query->countAllResults();
    }

    public function getFreelancerComUsuario($freelancerId = null)
    {
        $builder = $this->select('
            usuarios.nome, 
            usuarios.email, 
            freelancers.cpf, 
            freelancers.descricao, 
            freelancers.telefone, 
            freelancers.site, 
            freelancers.endereco,
            freelancers.especialidades,
            freelancers.dias_disponiveis,
            freelancers.valor_diaria,
            freelancers.curriculo
        ')->join('usuarios', 'usuarios.id = freelancers.fk_usuarios_id');

        if ($freelancerId !== null) {
            $builder->where('freelancers.fk_usuarios_id', $freelancerId);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResult();
    }
}
