<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="w-100" style="max-width: 400px;">
        <h3 class="text-center mb-4">Login</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
