<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TriggerDateArquivarProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
       

        CREATE TRIGGER trigger_date_arquivar_protocolo BEFORE UPDATE ON `protocolo_virtuais` FOR EACH ROW 
        BEGIN 
            SET @status_protocolo = NEW.status_protocolo_id; 
            IF (@status_protocolo = 3) THEN 
               SET NEW.date_arquivar_protocolo = CURRENT_TIMESTAMP; 
            ELSE
              SET NEW.date_arquivar_protocolo = null;
            END IF; 
        END
        

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER `trigger_date_arquivar_protocolo`");
        
    }
}
