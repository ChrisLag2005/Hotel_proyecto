<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            
            if (!Schema::hasColumn('habitaciones', 'imagen_original')) {
                $table->string('imagen_original')->nullable()->after('imagen');
            }
        });
    }

    public function down()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropColumn(['imagen_original']);
        });
    }
};