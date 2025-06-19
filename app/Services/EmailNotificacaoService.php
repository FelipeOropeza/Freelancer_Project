<?php

namespace App\Services;

class EmailNotificacaoService
{
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function enviar(array $dados): bool
    {
        $view = $dados['view'];

        $html = view($view, [
            'titulo' => $dados['titulo'],
            'mensagem' => $dados['mensagem'],
            'link_text' => $dados['link_text'],
            'parametro' => $dados['parametro'],
            'tipo' => $dados['tipo'] ?? null,
        ]);

        $this->email->setFrom('felipe2006.co@gmail.com', 'Job Flnder');
        $this->email->setTo($dados['email']);
        $this->email->setSubject($dados['assunto'] ?? 'Notificação');
        $this->email->setMessage($html);

        return $this->email->send();
    }
}
