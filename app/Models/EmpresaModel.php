<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['cnpj', 'descricao', 'telefone', 'site', 'endereco', 'fk_usuarios_id'];

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

    public function getEmpresaComUsuario($empresaId = null)
    {
        $builder = $this->select('
            usuarios.nome, 
            usuarios.email, 
            empresas.cnpj, 
            empresas.descricao, 
            empresas.telefone, 
            empresas.site, 
            empresas.endereco
        ')->join('usuarios', 'usuarios.id = empresas.fk_usuarios_id');

        if ($empresaId !== null) {
            $builder->where('empresas.fk_usuarios_id', $empresaId);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResult();
    }
}
