<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habitacion_servicio', function (Blueprint $table) {
            $table->id();
            
            // Claves foráneas
            $table->foreignId('habitacion_id')
                  ->constrained('habitaciones')
                  ->onDelete('cascade');
                  
            $table->foreignId('servicio_id')
                  ->constrained('servicios')
                  ->onDelete('cascade');
            
            // Campos adicionales opcionales
            $table->decimal('precio_extra', 8, 2)->default(0);
            $table->boolean('incluido')->default(false);
            
            $table->timestamps();
            
            // Hacer la combinación única
            $table->unique(['habitacion_id', 'servicio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habitacion_servicio');
    }
};