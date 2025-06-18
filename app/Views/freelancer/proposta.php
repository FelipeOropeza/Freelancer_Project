<?= $this->extend('layout/freelancer') ?>
<?= $this->section('style') ?>
<style>
    .btn-xs {
        padding: 0.15rem 0.4rem;
        font-size: 0.75rem;
        line-height: 1.2;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo_freelancer') ?>

<h2 class="mb-4">Minhas Propostas</h2>

<div class="list-group">
    <?php if (!empty($propostas)): ?>
        <?php foreach ($propostas as $proposta): ?>
            <div class="list-group-item mb-2 shadow-sm d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5 class="mb-1"><?= esc($proposta['descricao']) ?></h5>
                    <p class="mb-1">
                        <strong>Local:</strong> <?= esc($proposta['endereco']) ?> |
                        <strong>Tipo:</strong> <?= ucfirst(esc($proposta['tipo'])) ?> |
                        <strong>Valor:</strong> R$ <?= number_format($proposta['valor'], 2, ',', '.') ?> |
                        <strong>Status:</strong> <?= esc($proposta['status']) ?>
                    </p>
                </div>
                <div class="w-100 mt-2 d-flex">
                    <?php if ($proposta['status'] === 'pendente'): ?>
                        <form action="<?= route_to("proposta_aceitar", $proposta['id']) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button class="btn-success btn-sm mr-2 btn-xs">Aceitar</button>
                        </form>
                        <form action="<?= route_to("proposta_recusar", $proposta['id']) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button class="btn-danger btn-sm mr-2 btn-xs">Recusar</button>
                        </form>
                    <?php else: ?>
                        <span class="badge badge-secondary"><?= ucfirst($proposta['status']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma proposta encontrada.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>