<?php

namespace App\Mail;

use App\Models\ProtocoloVirtual;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailProtocoloVirtual extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $protocolo;
    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProtocoloVirtual $protocolo, $name = '')
    {
        $this->protocolo = $protocolo;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.licenca-ok')
                    ->subject('Protocolo virtual aprovado')
                    ->with([
                        'name'     => $this->name,
                        'protocolo'     => $this->protocolo,
                        'url'     => route('pesquisa'),
        ]);
    }
}
