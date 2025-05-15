<?= $this->extend('layout/default') ?>
<?= $this->section('style') ?>
<style>
    .btn-group .btn {
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-group .btn:hover {
        background-color: #2b6ca3;
        border-color: #265d8a;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h3 class="mb-4">Cadastro</h3>
    <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
        <label class="btn btn-primary active" id="btn-freelancer">
            <input type="radio" name="tipoUsuario" value="freelancer" autocomplete="off" checked> Freelancer
        </label>
        <label class="btn btn-primary" id="btn-empresa">
            <input type="radio" name="tipoUsuario" value="empresa" autocomplete="off"> Empresa
        </label>
    </div>
    <form>
        <div class="form-group" id="nomeGroup">
            <label for="nome">Nome completo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group d-none" id="empresaNomeGroup">
            <label for="empresa_nome">Nome da empresa</label>
            <input type="text" class="form-control" id="empresa_nome" name="empresa_nome">
        </div>

        <div class="form-group" id="cpfGroup">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf">
        </div>

        <div class="form-group d-none" id="cnpjGroup">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn btn-success mb-4">Cadastrar</button>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        console.log('script carregado');

        $('input[name="tipoUsuario"]').change(function () {
            if ($(this).val() === 'empresa') {
                $('#empresaNomeGroup, #cnpjGroup').removeClass('d-none');
                $('#cpfGroup, #nomeGroup').addClass('d-none');
            } else {
                $('#empresaNomeGroup, #cnpjGroup').addClass('d-none');
                $('#cpfGroup, #nomeGroup').removeClass('d-none');
            }
        });
    });
</script>

<?= $this->endSection() ?>