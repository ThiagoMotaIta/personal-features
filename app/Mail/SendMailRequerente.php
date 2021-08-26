<?php

namespace App\Mail;

use App\Models\ProtocoloVirtual;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\User;

class SendMailRequerente extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $protocolo;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProtocoloVirtual $protocolo, User $user)
    {
        $this->protocolo = $protocolo;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.requerente')
                    ->subject('Protocolo Virtual')
                    ->with([
                        'protocolo'     => $this->protocolo,
                        'requerente'     => $this->user,
                        'url'     => route('pesquisa'),
        ]);
    }
}
