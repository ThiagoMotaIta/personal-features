<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHistoricoProtocoloAddFieldNoteDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historico_protocolo', function (Blueprint $table) {
            $table->string('note_document', 400)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historico_protocolo', function (Blueprint $table) {
            $table->dropColumn('note_document');      
        });
    }
}
