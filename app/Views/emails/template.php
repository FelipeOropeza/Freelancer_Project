<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f6f6f6;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      background-color: #ffffff;
      margin: auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    h1 {
      color: #333333;
    }

    p {
      color: #555555;
      font-size: 16px;
      line-height: 1.6;
    }

    .footer {
      text-align: center;
      color: #999999;
      font-size: 12px;
      margin-top: 30px;
    }

    .btn {
      display: inline-block;
      padding: 12px 24px;
      margin-top: 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1><?= $titulo ?></h1>
    <p><?= $mensagem ?></p>
    <?php if (isset($link_text) && isset($parametro)): ?>
      <a class="btn" href="<?= site_url('valida/email?email=' . urlencode($parametro)) ?>"
        target="_blank"><?= $link_text ?></a>
    <?php endif; ?>
    <div class="footer">
      <p>&copy; <?= date('Y') ?> Sua Empresa. Todos os direitos reservados.</p>
    </div>
  </div>
</body>

</html>