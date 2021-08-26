<?php

namespace App\Listeners;

use App\Events\CreatedProtocolo;
use App\Mail\SendMailRequerente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendMailCreatedProtocolo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatedProtocolo  $event
     * @return void
     */
    public function handle(CreatedProtocolo $event)
    {
        // Registring log commented post
        if($event->protocolo()->licenca == 'pf' AND $event->protocolo()->requerente == 0){
            $requerente = User::where('cpf', $event->protocolo()->cpf)->first();
            //Log::info($requerente);
            Mail::to($requerente->email)->send(new SendMailRequerente($event->protocolo(), $requerente));
            
        }else{
            Log::info("Requerente");
        }
        
    }
}
