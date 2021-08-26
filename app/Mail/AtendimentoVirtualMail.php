<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\AtendimentoVirtual;


class AtendimentoVirtualMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $atendimentoVirtual;
    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AtendimentoVirtual $atendimentoVirtual, $link)
    {
        $this->atendimentoVirtual = $atendimentoVirtual;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('emails.atendimento-virtual')
                    ->subject('Agendamento Atendimento Virtual')
                    ->with([
                        'atendimentoVirtual'     => $this->atendimentoVirtual,
                        'link'     => $this->link,
                        'url'     => route('pesquisa'),
        ]);

    }
}
