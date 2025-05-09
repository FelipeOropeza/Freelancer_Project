<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FreelaNet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <?= $this->include('layout/css') ?>
</head>

<body>
    <?= $this->include('layout/peloader') ?>
    <?= $this->include('layout/header') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('layout/footer') ?>
    <?= $this->include('layout/scripts') ?>
</body>

</html>