<?= $this->extend('layout/default') ?>

<?= $this->section('style') ?>
<style>
    .job-category-listing {
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        margin-right: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .single-listing {
        margin-bottom: 20px;
    }

    button.btn:hover {
        background-color: #d91e5c;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="slider-area">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center"
        data-background="assets/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Encontre um trabalho</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Área de Listagem de Vagas -->
<div class="job-listing-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <!-- Filtros -->
            <div class="col-xl-3 col-lg-3 col-md-4 mb-4">
                <form method="get" action="<?= base_url('/buscar-vagas') ?>">
                    <div class="job-category-listing mb-55">

                        <!-- Filtro Categoria -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Categoria</h4>
                            </div>
                            <div class="select-job-items2">
                                <select name="categoria" class="form-control">
                                    <option value="">Todas</option>
                                    <option value="garcom">Garçom</option>
                                    <option value="cozinheiro">Cozinheiro</option>
                                    <option value="atendente">Atendente</option>
                                    <option value="limpeza">Limpeza</option>
                                    <option value="seguranca">Segurança</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filtro Valor Diário -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Valor da Diária</h4>
                            </div>
                            <div class="select-job-items2">
                                <input type="number" class="form-control" name="valor" placeholder="Ex.: 150">
                            </div>
                        </div>

                        <!-- Filtro Dias da Semana -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Dias Disponíveis</h4>
                            </div>
                            <?php
                            $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
                            foreach ($dias as $dia):
                                ?>
                                <label class="container">
                                    <?= ucfirst($dia) . '-feira' ?>
                                    <input type="checkbox" name="dias[]" value="<?= $dia ?>">
                                    <span class="checkmark"></span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <!-- Botão de Pesquisa -->
                        <div class="single-listing">
                            <button type="submit" class="btn btn-primary w-100">Pesquisar</button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- Lista de Vagas -->
            <div class="col-xl-9 col-lg-9 col-md-8">
                <section class="featured-job-area">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="count-job mb-35">
                                    <span><?= $totalFreela ?> Freelacers Encontrados</span>
                                </div>
                            </div>
                        </div>

                        <!-- Exemplo de vaga -->
                        <?php foreach ($freelancers as $freelancer): ?>
                            <div class="single-job-items mb-30"
                                style="display: flex; justify-content: space-between; align-items: center;">

                                <div class="job-items" style="display: flex; align-items: center; gap: 15px; flex: 1;">
                                    <div class="company-img">
                                        <a href="#"><img src="assets/img/icon/trabalho-freelance.png" width="50" height="50"
                                                alt=""></a>
                                    </div>
                                    <div class="job-tittle job-tittle2" style="flex: 1;">
                                        <a href="#">
                                            <h4><?= esc($freelancer['nome']) ?></h4>
                                        </a>
                                        <?php
                                        $especialidades = $freelancer['especialidades'] ?? 'Não informado';
                                        $especialidadesArray = array_map('trim', explode(',', $especialidades));
                                        $primeira = $especialidadesArray[0];
                                        $especialidadeExibida = (count($especialidadesArray) > 1) ? esc($primeira) . '...' : esc($primeira);
                                        ?>
                                        <li>Especialidade: <?= $especialidadeExibida ?></li>
                                        <ul
                                            style="list-style: none; padding: 0; margin: 0; display: flex; gap: 15px; font-size: 14px;">

                                            <li><i class="fas fa-map-marker-alt"></i> São Paulo, SP</li>
                                            <li>
                                                <?= $freelancer['valor_diaria']
                                                    ? 'R$ ' . number_format($freelancer['valor_diaria'], 2, ',', '.')
                                                    : 'Sem valor' ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="items-link items-link2 f-right" style="margin-left: 20px;">
                                    <a href="#">Ver Detalhes</a>
                                </div>

                            </div>
                        <?php endforeach; ?>


                        <!-- Repita o bloco acima para outras vagas -->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- Paginação -->
<?php if ($pager): ?>
    <div class="pagination-area pb-115 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <?= $pager->links('freelancers', 'foundation_full') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>