<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
    <div class="container pt-50 pb-50">
        <div class="row">
            <!-- Menu Lateral -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Área da Empresa</h5>
                        <ul class="list-unstyled">
                            <li><a href="/empresa/perfil">Meu Perfil</a></li>
                            <li><a href="/empresa/emails">Emails</a></li>
                            <li><a href="/empresa/contratos">Contratos</a></li>
                            <li><a href="/empresa/propostas">Propostas</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Conteúdo da Página -->
            <div class="col-md-9">
                <?= $this->renderSection('conteudo_empresa') ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
