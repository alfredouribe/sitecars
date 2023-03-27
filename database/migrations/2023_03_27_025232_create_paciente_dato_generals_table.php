<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteDatoGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_dato_generals', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', '500');
            $table->string('ocupacion', '100');
            $table->string('escolaridad', '150');
            $table->string('estado_civil', '100');
            $table->string('lugar_nacimiento', '150');
            $table->string('religion', '150');
            $table->string('tutor', '100');
            $table->string('motivo_consulta', '500');
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
        Schema::dropIfExists('paciente_dato_generals');
    }
}
