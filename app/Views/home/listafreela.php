<?= $this->extend('layout/default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css" />
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

    .noUi-horizontal .noUi-handle {
        background: #d91e5c;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    #valor_min,
    #valor_max {
        width: 48%;
        padding: 10px 12px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        color: #333;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        height: 42px;
    }

    #valor_min::placeholder,
    #valor_max::placeholder {
        color: #aaa;
    }

    #valor_min:focus,
    #valor_max:focus {
        outline: none;
        border-color: #d91e5c;
        box-shadow: 0 0 5px rgba(217, 30, 92, 0.5);
        background-color: #fff;
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
                        <h2>Encontre um freelancer</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="job-listing-area pt-120 pb-120">
    <div class="container">
        <div class="row">

            <!-- Filtros -->
            <div class="col-xl-3 col-lg-3 col-md-4 mb-4">
                <form method="get" action="<?= base_url('/lista') ?>">
                    <div class="job-category-listing mb-55">

                        <!-- Filtro Categoria -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Categoria</h4>
                            </div>
                            <div class="select-job-items2">
                                <select name="categoria" class="form-control">
                                    <option value="" <?= empty($categoriaSelecionada) ? 'selected' : '' ?>>Todas</option>
                                    <option value="cozinhabrasileira" <?= ($categoriaSelecionada ?? '') === 'cozinhabrasileira' ? 'selected' : '' ?>>Cozinha Brasileira</option>
                                    <option value="cozinhaitaliana" <?= ($categoriaSelecionada ?? '') === 'cozinhaitaliana' ? 'selected' : '' ?>>Cozinha Italiana</option>
                                    <option value="cozinhajaponesa" <?= ($categoriaSelecionada ?? '') === 'cozinhajaponesa' ? 'selected' : '' ?>>Cozinha Japonesa</option>
                                    <option value="confeitaria" <?= ($categoriaSelecionada ?? '') === 'confeitaria' ? 'selected' : '' ?>>Confeitaria</option>
                                    <option value="panificacao" <?= ($categoriaSelecionada ?? '') === 'panificacao' ? 'selected' : '' ?>>Panificação</option>
                                    <option value="cozinhavegetariana" <?= ($categoriaSelecionada ?? '') === 'cozinhavegetariana' ? 'selected' : '' ?>>Cozinha Vegetariana</option>
                                    <option value="buffet" <?= ($categoriaSelecionada ?? '') === 'buffet' ? 'selected' : '' ?>>Buffet</option>
                                    <option value="gastronomiamolecular" <?= ($categoriaSelecionada ?? '') === 'gastronomiamolecular' ? 'selected' : '' ?>>Gastronomia Molecular</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filtro Valor Diário -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Valor da Diária (R$)</h4>
                            </div>
                            <div id="range-slider"></div>
                            <div class="d-flex justify-content-between mt-2">
                                <input type="number" id="valor_min" name="valor_min" class="form-control"
                                    value="<?= esc($valorMin ?? '') ?>" placeholder="Mínimo">
                                <input type="number" id="valor_max" name="valor_max" class="form-control"
                                    value="<?= esc($valorMax ?? '') ?>" placeholder="Máximo">
                            </div>
                        </div>

                        <!-- Filtro Dias da Semana -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Dias Disponíveis</h4>
                            </div>
                            <?php
                            $diasSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
                            foreach ($diasSemana as $dia):
                                $checked = (in_array($dia, $diasSelecionados ?? [])) ? 'checked' : '';
                                ?>
                                <label class="container">
                                    <?= ucfirst($dia) . '-feira' ?>
                                    <input type="checkbox" name="dias[]" value="<?= $dia ?>" <?= $checked ?> />
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
                                    <span><?= $totalFreela ?> Freelancers Encontrados</span>
                                </div>
                            </div>
                        </div>

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
                                        <li>Especialidade: <?= esc($freelancer['especialidade_formatada']) ?></li>
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

<?= $this->section('javascript') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<script>
    const slider = document.getElementById('range-slider');

    noUiSlider.create(slider, {
        start: [<?= $valorMin ?? 0 ?>, <?= $valorMax ?? 1000 ?>],
        connect: true,
        step: 10,
        range: {
            'min': <?= $minValorGlobal ?? 0 ?>,
            'max': <?= $maxValorGlobal ?? 1000 ?>
        },
        tooltips: false,
        format: {
            to: value => Math.round(value),
            from: value => Number(value)
        }
    });

    const inputMin = document.getElementById('valor_min');
    const inputMax = document.getElementById('valor_max');

    slider.noUiSlider.on('update', function (values) {
        inputMin.value = values[0];
        inputMax.value = values[1];
    });

    inputMin.addEventListener('change', function () {
        slider.noUiSlider.set([this.value, null]);
    });

    inputMax.addEventListener('change', function () {
        slider.noUiSlider.set([null, this.value]);
    });
</script>
<?= $this->endSection() ?>