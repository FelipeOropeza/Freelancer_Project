<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container pt-50 pb-50">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Área do Freelancer</h5>
                    <ul class="list-unstyled">
                        <li><a style="color: #fb246a;" href="<?= url_to("freelancer_perfil") ?>">Meu Perfil</a></li>
                        <li><a style="color: #fb246a;" href="#">Propostas</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Conteúdo da Página -->
        <div class="col-md-9">
            <?= $this->renderSection('conteudo_freelancer') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>