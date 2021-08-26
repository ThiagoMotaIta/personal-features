<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TriggerStatusProtocoloUpdated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
       

        CREATE TRIGGER trigger_status_protocolo_updated BEFORE UPDATE ON `protocolo_virtuais` FOR EACH ROW 
        BEGIN
        IF NEW.status_protocolo_id != OLD.status_protocolo_id THEN
        SET NEW.status_protocolo_updated_at = NOW();
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
        DB::unprepared("DROP TRIGGER `trigger_status_protocolo_updated`");
    }
}
