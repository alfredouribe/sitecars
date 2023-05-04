<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndodonciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endodoncias', function (Blueprint $table) {
            $table->id();
            $table->enum('conducto', ['Palatino', 'Vestibular', 'Mesio-vestibular', 'Mesio-Lingual', 'Distal', 'Unico'])->nullable()->default(null);
            $table->string('mm', '100');
            $table->string('referencia', '100');
            $table->string('fo', '100');
            $table->string('gates', '100');
            $table->string('retroceso', '100');
            $table->string('lima_maestra', '100');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endodoncias');
    }
}
