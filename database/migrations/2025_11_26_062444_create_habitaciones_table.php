<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('habitaciones', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique();
        $table->string('tipo');
        $table->text('descripcion')->nullable();
        $table->decimal('precio', 8, 2);
        $table->integer('capacidad');
        $table->enum('estado', ['disponible', 'ocupada', 'mantenimiento'])->default('disponible');
        $table->string('imagen')->nullable(); 
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
