<?php

namespace App\Mail;

use App\Models\ProtocoloVirtual;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailApplicantConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $protocolo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProtocoloVirtual $protocolo)
    {
        $this->protocolo = $protocolo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.applicant-confirmation')
                    ->subject('Protocolo Virtual Confirmação de Responsabilidade')
                    ->with([
                        'protocolo'     => $this->protocolo,
                        'url'     => route('pesquisa'),
        ]);
    }
}
