<?php

namespace App\Mail;

use App\Models\Ouvidoria;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailOuvidoria extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $ouvidoria;
    protected $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ouvidoria $ouvidoria, $mensagem)
    {
        $this->ouvidoria = $ouvidoria;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ouvidoria')
                    ->subject('Fale Conosco')
                    ->with([
                        'user'     => $this->ouvidoria,
                        'mensagem'     => $this->mensagem,
                        'url'     => route('pesquisa'),
        ]);
    }
}
