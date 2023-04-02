<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentePatologicoHeredoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_patologico_heredo_familiars', function (Blueprint $table) {
            $table->id();
            $table->enum('diabetes', ['SI', 'NO'])->nullable()->default(null);
            $table->string('diabetes_familiar', '300')->nullable()->default(null);
            $table->enum('hipertension', ['SI', 'NO'])->nullable()->default(null);
            $table->string('hipertension_familiar', '300')->nullable()->default(null);
            $table->enum('cardiopatias', ['SI', 'NO'])->nullable()->default(null);
            $table->string('cardiopatias_familiar', '300')->nullable()->default(null);
            $table->enum('cancer', ['SI', 'NO'])->nullable()->default(null);
            $table->string('cancer_familiar', '300')->nullable()->default(null);
            $table->enum('asma', ['SI', 'NO'])->nullable()->default(null);
            $table->string('asma_familiar', '300')->nullable()->default(null);
            $table->enum('renal', ['SI', 'NO'])->nullable()->default(null);
            $table->string('renal_familiar', '300')->nullable()->default(null);
            $table->enum('hemofilia', ['SI', 'NO'])->nullable()->default(null);
            $table->string('hemofilia_familiar', '300')->nullable()->default(null);
            $table->enum('hipotension', ['SI', 'NO'])->nullable()->default(null);
            $table->string('hipotension_familiar', '300')->nullable()->default(null);
            $table->enum('convulsiones', ['SI', 'NO'])->nullable()->default(null);
            $table->string('convulsiones_familiar', '300')->nullable()->default(null);
            $table->enum('vih', ['SI', 'NO'])->nullable()->default(null);
            $table->string('vih_familiar', '300')->nullable()->default(null);
            $table->enum('anemia', ['SI', 'NO'])->nullable()->default(null);
            $table->string('anemia_familiar', '300')->nullable()->default(null);
            $table->enum('neoplasias', ['SI', 'NO'])->nullable()->default(null);
            $table->string('neoplasias_familiar', '300')->nullable()->default(null);
            $table->string('observaciones', '1000')->nullable()->default(null);
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
        Schema::dropIfExists('antecedente_patologico_heredo_familiars');
    }
}
