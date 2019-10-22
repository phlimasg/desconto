<?php

namespace App\Mail;

use App\Model\candidato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DescontoAutorizado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(candidato $candidato)
    {
        $this->candidato = $candidato;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from('sendmail@abel.org.br','La Salle Abel - Desconto Comercial')
        ->subject('Desconto Comercial - Resultado')
        ->replyTo('descontocomercial.abel@lasalle.org.br','Comissão de descontos comerciais')
        ->with([
            'nome_cand' => $this->candidato->nome_cand,
            'desc_aut' => $this->candidato->desc_aut,
            'nome_fin' => $this->candidato->respfin->nome_fin,
        ])
        ->view('mail.autorizado');
    }
}
