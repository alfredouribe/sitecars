<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentePersonalNoPatologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_personal_no_patologicos', function (Blueprint $table) {
            $table->id();
            $table->enum('frecuencia_cepillado', ['1', '2', '3'])->nullable()->default(null);
            $table->enum('hilo_dental', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('medicamento', ['SI', 'NO'])->nullable()->default(null);
            $table->string('medicamento_descripcion', '500')->nullable()->default(null);
            $table->enum('tratamiento_medico', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('operacion', ['SI', 'NO'])->nullable()->default(null);
            $table->string('operacion_descripcion', '500')->nullable()->default(null);
            $table->enum('transferencia_sangre', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('consumo_drogas', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('tabaquismo', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('alcoholismo', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('tatuajes', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('embarazo', ['SI', 'NO'])->nullable()->default(null);
            $table->double('embarazo_meses', 15, 8)->nullable()->default(null);
            $table->enum('alergias', ['SI', 'NO'])->nullable()->default(null);
            $table->string('alergias_descripcion', '500')->nullable()->default(null);
            $table->enum('vacunas', ['SI', 'NO'])->nullable()->default(null);
            $table->string('vacunas_faltantes', '500')->nullable()->default(null);
            $table->enum('alergias_anestesico', ['SI', 'NO'])->nullable()->default(null);
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
        Schema::dropIfExists('antecedente_personal_no_patologicos');
    }
}
