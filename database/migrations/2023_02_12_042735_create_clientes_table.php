<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 50);
            $table->string("segundoNombre", 50)->nullable();
            $table->string("apellidoPaterno", 50)->nullable();
            $table->string("apellidoMaterno", 50)->nullable();
            $table->string("telefono", 15);
            $table->string("email", 60);
            $table->boolean("activo")->default(1);
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
        Schema::dropIfExists('clientes');
    }
}
