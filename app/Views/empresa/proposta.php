<?= $this->extend('layout/empresa') ?>

<?= $this->section('style') ?>
<style>
    textarea {
        resize: none;
        height: 60px;
    }

    .badge-info {
        background-color: #17a2b8;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
    }

    .btn-xs {
        padding: 0.15rem 0.4rem;
        font-size: 0.75rem;
        line-height: 1.2;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo_empresa') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Propostas</h2>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalFormulario">
        Nova Proposta
    </button>
</div>

<!-- Lista de Propostas -->
<div class="list-group">
    <?php foreach ($propostas as $proposta): ?>
        <div class="list-group-item mb-2 shadow-sm">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5 class="mb-1"><?= esc($proposta['titulo']) ?></h5>
                    <small class="text-muted"><?= esc($proposta['descricao']) ?></small>
                    <p class="mb-1">
                        <strong>Valor:</strong> R$<?= number_format($proposta['valor'], 2, ',', '.') ?> |
                        <strong>Tipo:</strong>
                        <span class="badge badge-info"><?= strtoupper($proposta['tipo']) ?></span> |
                        <strong>Endereço:</strong> <?= esc($proposta['endereco']) ?>
                        <?= date('d/m/Y', strtotime($proposta['data_inicio'])) ?> -
                        <?= date('d/m/Y', strtotime($proposta['data_conclusao'])) ?>
                    </p>
                </div>
                <div class="w-100 mt-2 d-flex">
                    <!-- <button class="btn btn-warning btn-sm mr-2 btn-xs" data-toggle="modal" data-target="#modalFormulario"> -->
                    <button class="btn-warning btn-sm mr-2 btn-xs">
                        <small>Atualizar</small>
                    </button>
                    <a href="#" class="btn-danger btn-sm btn-xs">
                        <small>Excluir</small>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal com Formulário -->
<div class="modal fade" id="modalFormulario" tabindex="-1" role="dialog" aria-labelledby="modalFormularioLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= url_to("empresa_proposta_salvar"); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormularioLabel">Cadastrar / Atualizar Proposta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="titulo">Título<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="valor">Valor (R$)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" name="valor" id="valor"
                                step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipo" style="display:block; margin-bottom:5px;">Tipo<span
                                    class="text-danger">*</span></label>
                            <select name="tipo" id="tipo" class="form-control form-control-sm" required>
                                <option value="">Selecione</option>
                                <option value="remoto">Remoto</option>
                                <option value="presencial">Presencial</option>
                                <option value="hibrido">Híbrido</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endereco">Endereço<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="endereco" id="endereco"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="2"
                            required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="data_inicio">Data de Início<span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="data_inicio" id="data_inicio"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="data_conclusao">Data de Conclusão<span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="data_conclusao"
                                id="data_conclusao" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>