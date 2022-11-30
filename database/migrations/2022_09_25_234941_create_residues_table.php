<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('common_name', 255);
            $table->string('type', 50);
            $table->string('category', 50);
            $table->string('treatment_technology', 50);
            $table->string('class', 10);
            $table->string('measurement_unit', 2);
            $table->decimal('weight', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residues');
    }
};
