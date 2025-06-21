<?= $this->extend('layout/freelancer') ?>

<?= $this->section('style') ?>
<style>
    .badge-status {
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
    }

    .badge-aceito {
        background-color: #28a745;
        color: white;
    }

    .badge-recusada {
        background-color: #dc3545;
        color: white;
    }

    .badge-pendente {
        background-color: #ffc107;
        color: black;
    }

    .btn-xs {
        padding: 0.2rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo_freelancer') ?>

<h2>Contratos</h2>

<div class="list-group">
    <?php foreach ($contratos as $contrato): ?>
        <div class="list-group-item mb-2 shadow-sm">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5 class="mb-1"><?= esc($contrato['nome_empresa'] ?? 'Empresa') ?></h5>

                    <div>
                        <small><strong>Assinatura Freelancer:</strong>
                            <span class="badge badge-status badge-<?= esc($contrato['assinatura_freelancer']) ?>">
                                <?= ucfirst($contrato['assinatura_freelancer']) ?>
                            </span>
                        </small><br>
                        <?php if ($contrato['assinatura_freelancer'] === 'recusada'): ?>
                            <small><strong>Assinatura Empresa:</strong>
                                <span class="badge badge-status badge-recusada"> Recusada
                                </span>
                            </small>
                        <?php else: ?>
                            <small><strong>Assinatura Empresa:</strong>
                                <span class="badge badge-status badge-<?= esc($contrato['assinatura_empresa']) ?>">
                                    <?= ucfirst($contrato['assinatura_empresa']) ?>
                                </span>
                            </small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="w-100 mt-3 d-flex flex-wrap gap-2">
                    <a href="<?= route_to('ver_contrato', $contrato['contrato']) ?>" target="_blank"
                        class="btn-primary btn-sm btn-xs mr-2">
                        Visualizar Contrato
                    </a>

                    <?php if ($contrato['assinatura_freelancer'] === 'pendente'): ?>
                        <form action="<?= url_to('assinar_contrato_freelancer') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $contrato['id'] ?>">
                            <button type="submit" name="resposta" value="aceito" class="btn btn-success btn-sm btn-xs mr-1">
                                Aceitar
                            </button>
                            <button type="submit" name="resposta" value="recusada" class="btn btn-danger btn-sm btn-xs">
                                Recusar
                            </button>
                        </form>

                    <?php elseif ($contrato['assinatura_freelancer'] === 'aceito' && $contrato['assinatura_empresa'] === 'recusada'): ?>
                        <span class="text-danger"><em>A empresa recusou este contrato após sua aceitação.</em></span>

                    <?php else: ?>
                        <span class="text-muted"><em>Freelancer já respondeu.</em></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>