<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('idEmpleado');
            $table->string('rutEmpleado');
            $table->string('nombreEmpleado');
            $table->string('apellidoEmpleado');
            $table->timestamps();

            $table->foreign('idEmpleado')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
