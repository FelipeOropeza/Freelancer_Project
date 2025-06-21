<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contrato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        p {
            text-align: justify;
        }
    </style>
</head>

<body>
    <h1>Contrato de Prestação de Serviço</h1>

    <p>
        Pelo presente instrumento particular, de um lado <strong><?= $nome_empresa ?></strong>, doravante denominada
        CONTRATANTE, e de outro lado o(a) profissional <strong><?= $nome_freelancer ?></strong>, doravante denominado(a)
        CONTRATADO(A), têm entre si justo e contratado o seguinte:
    </p>

    <p>
        O CONTRATADO se compromete a executar os serviços de <strong><?= strtolower($titulo) ?></strong>, cuja atividade
        consiste em <strong><?= strtolower($descricao) ?></strong>, de forma <?= $tipo ?>, no endereço
        <strong><?= $endereco ?></strong>. O serviço deverá ser iniciado em
        <strong><?= date('d/m/Y', strtotime($data_inicio)) ?></strong> e concluído até
        <strong><?= date('d/m/Y', strtotime($data_conclusao)) ?></strong>.
    </p>

    <p>
        Pelo serviço prestado, o CONTRATANTE pagará ao CONTRATADO o valor total de <strong>R$
            <?= number_format($valor, 2, ',', '.') ?></strong>, conforme acordado entre as partes.
    </p>

    <p>
        Ambas as partes declaram, por meio deste contrato, estarem cientes e de acordo com os termos estabelecidos. O
        presente instrumento entra em vigor na data da assinatura pelas partes.
    </p>

    <p style="margin-top: 50px;">
        Declaro, para os devidos fins, que este contrato será firmado por meio digital, com aceite registrado no sistema
        da plataforma.<br><br>
        <strong><?= $nome_empresa ?></strong><br>
        CONTRATANTE
    </p>

    <p style="margin-top: 30px;">
        Declaro, para os devidos fins, que este contrato será firmado por meio digital, com aceite registrado no sistema
        da plataforma.<br><br>
        <strong><?= $nome_freelancer ?></strong><br>
        CONTRATADO(A)
    </p>

</body>

</html>