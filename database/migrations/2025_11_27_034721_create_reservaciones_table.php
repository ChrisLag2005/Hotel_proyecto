<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios (clientes)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relación con habitaciones
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');

            // Datos de reserva
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('adultos');
            $table->integer('ninos')->default(0); // Evitar acentos en nombres de columnas
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'finalizada'])->default('pendiente');
            $table->decimal('total', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservaciones');
    }
};
