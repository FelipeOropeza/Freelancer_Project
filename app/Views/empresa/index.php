<?= $this->extend('layout/empresa') ?>

<?= $this->section('conteudo_empresa') ?>
<div class="container mt-4">
    <h2 class="mb-4">Meu Perfil</h2>
    <p>Aqui estão os dados da sua empresa...</p>

    <form action="<?= url_to('empresa_info') ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome da Empresa <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" maxlength="100"
                placeholder="Digite o nome da empresa" value="<?= esc($dados->nome); ?>" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição <span class="text-danger">*</span></label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Descrição da empresa"
                required><?= esc($dados->descricao); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefone">Telefone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telefone" name="telefone" maxlength="11"
                    placeholder="(xx) xxxxx-xxxx" value="<?= esc($dados->telefone); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="site">Site</label>
                <input type="text" class="form-control" id="site" name="site" maxlength="80"
                    placeholder="https://www.seusite.com" value="<?= esc($dados->site); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="endereco" name="endereco" maxlength="30"
                placeholder="Rua, número, bairro" value="<?= esc($dados->endereco); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
<?= $this->endSection() ?>