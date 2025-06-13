<?= $this->extend('layout/freelancer') ?>

<?= $this->section('conteudo_freelancer') ?>
<div class="container mt-4">
    <h2 class="mb-4">Meu Perfil Freelancer</h2>

    <form action="<?= route_to('freelancer_info') ?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cpf">CPF <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
                    value="<?= esc($dados->cpf ?? ''); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="telefone">Telefone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telefone" name="telefone" maxlength="11"
                    value="<?= esc($dados->telefone ?? ''); ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição <span class="text-danger">*</span></label>
            <textarea class="form-control" style="resize: none;" id="descricao" name="descricao" rows="2"
                required><?= esc($dados->descricao ?? ''); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="especialidades">Especialidades <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="especialidades" name="especialidades" maxlength="100"
                    value="<?= esc($dados->especialidades ?? ''); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="dias_disponiveis">Dias Disponíveis <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="dias_disponiveis" name="dias_disponiveis" maxlength="100"
                    value="<?= esc($dados->dias_disponiveis ?? ''); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="valor_diaria">Valor Diária (R$) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="valor_diaria" name="valor_diaria" step="0.01"
                    value="<?= esc($dados->valor_diaria ?? ''); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="site">Site / Portfólio</label>
                <input type="text" class="form-control" id="site" name="site" maxlength="80"
                    value="<?= esc($dados->site ?? ''); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="endereco" name="endereco" maxlength="100"
                value="<?= esc($dados->endereco ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="curriculo">Currículo <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="curriculo" name="curriculo" style="max-width: 350px;">
            <?php if (!empty($dados->curriculo)): ?>
                <small class="form-text mt-1">
                    Currículo atual:
                    <a style="color: #007bff;" href="<?= route_to('ver_curriculo', $dados->curriculo) ?>" target="_blank">
                        Visualizar Currículo
                    </a>
                </small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
    </form>
</div>
<?= $this->endSection() ?>