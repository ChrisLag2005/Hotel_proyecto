<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
    
            if (!Schema::hasColumn('habitaciones', 'precio_noche')) {
                $table->decimal('precio_noche', 8, 2)->default(0)->after('capacidad');
            }
            
          
            if (!Schema::hasColumn('habitaciones', 'imagen')) {
                $table->string('imagen')->nullable()->after('precio_noche');
            }
            
            if (!Schema::hasColumn('habitaciones', 'imagen_original')) {
                $table->string('imagen_original')->nullable()->after('imagen');
            }
        });
    }

    public function down()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropColumn(['imagen', 'imagen_original']);
          
        });
    }
};