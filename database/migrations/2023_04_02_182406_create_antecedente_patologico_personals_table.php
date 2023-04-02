<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentePatologicoPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_patologico_personals', function (Blueprint $table) {
            $table->id();
            $table->enum('diabetes', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('hipertension', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('hipotension', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('cardiopatias', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('cancer', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('hemofilia', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('hepatitis', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('amigdalitis', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('vih', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('convulsiones', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('asma', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('anemia', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('tosferina', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('artritis', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('varicela', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('rubeola', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('sarampion', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('fiebre', ['SI', 'NO'])->nullable()->default(null);
            $table->enum('tuberculosis', ['SI', 'NO'])->nullable()->default(null);
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
        Schema::dropIfExists('antecedente_patologico_personals');
    }
}
