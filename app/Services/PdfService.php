<?php

namespace App\Services;

use Dompdf\Dompdf;

class PdfService
{
    protected $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function gerarContrato(array $dadosProjeto, string $nomeFreelancer): string
    {
        try {
            $projeto = $dadosProjeto[0];

            $html = view('pdf/contrato', [
                'nome_empresa' => $projeto['nome'],
                'titulo' => $projeto['titulo'],
                'descricao' => $projeto['descricao'],
                'endereco' => $projeto['endereco'],
                'data_inicio' => $projeto['data_inicio'],
                'data_conclusao' => $projeto['data_conclusao'],
                'tipo' => $projeto['tipo'],
                'valor' => $projeto['valor'],
                'status' => $projeto['status'],
                'nome_freelancer' => $nomeFreelancer,
            ]);

            $nomeArquivo = 'contrato_' . time() . '.pdf';
            $caminhoPasta = FCPATH . 'uploads/contratos/';

            if (!is_dir($caminhoPasta)) {
                mkdir($caminhoPasta, 0777, true);
            }

            $caminhoCompleto = $caminhoPasta . $nomeArquivo;

            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4', 'portrait');
            $this->dompdf->render();

            file_put_contents($caminhoCompleto, $this->dompdf->output());

            return $nomeArquivo;
        } catch (\Throwable $e) {
            echo "Erro ao gerar PDF: " . $e->getMessage();
            return '';
        }
    }
}
