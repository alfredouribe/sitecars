<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdontogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontogramas', function (Blueprint $table) {
            $table->id();
            $table->integer("cuadrante");
            $table->integer("diente");
            $table->enum('codigo_1', ['black', 'blue', 'yellow', 'orange', 'green', 'brown', 'red'])->nullable()->default(null);
            $table->enum('codigo_2', ['black', 'blue', 'yellow', 'orange', 'green', 'brown', 'red'])->nullable()->default(null);
            $table->enum('codigo_3', ['black', 'blue', 'yellow', 'orange', 'green', 'brown', 'red'])->nullable()->default(null);
            $table->enum('codigo_4', ['black', 'blue', 'yellow', 'orange', 'green', 'brown', 'red'])->nullable()->default(null);
            $table->enum('codigo_5', ['black', 'blue', 'yellow', 'orange', 'green', 'brown', 'red'])->nullable()->default(null);
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
        Schema::dropIfExists('odontogramas');
    }
}
