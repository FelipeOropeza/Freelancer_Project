<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'FreelaNet') ?></title>   
</head>
<body>
    <?= $this->include('loja/layouts/navbar') ?>

    <main class="flex-grow-1">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('loja/layouts/footer') ?>

    <?= $this->renderSection('javascript') ?>
</body>

</html>