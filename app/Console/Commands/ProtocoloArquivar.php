<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\ProtocoloVirtual;

class ProtocoloArquivar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'protocolo:arquivar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arquiva protocolo passados 45 dias com o status pendente';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $protocolos = ProtocoloVirtual::where('status_protocolo_id', 3)->get();

        foreach ($protocolos as $key => $protocolo) {
            //dd($protocolo->date_arquivar_protocolo);
            $dt = Carbon::create($protocolo->date_arquivar_protocolo);
            
            $future = Carbon::now();
            $diff = $dt->diffInMinutes($future);

            //$diff = $dt->diffInDays($future);

            if($diff >= 1){
                $protocolo->status_protocolo_id = 5;
                $protocolo->save();
                $protocolo->delete();
            }
        }

        $this->info('Verificação de protocolo com pendências passando do prazo verificado');
    }
}
