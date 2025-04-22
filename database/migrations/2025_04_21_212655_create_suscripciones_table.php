<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            
            // Usamos enum para los paquetes, por ejemplo: 'básico', 'premium', etc.
            $table->enum('paquete', ['básico', 'premium', 'avanzado'])->default('básico');
            
            // Usamos enum para el estado de la suscripción
            $table->enum('estado', ['activa', 'vencida', 'suspendida'])->default('activa');
            
            $table->timestamps();
        
            // Llave foránea para el cliente
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suscripciones');
    }
}
