<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ClienteSeeder::class,     
            HabitacionSeeder::class,  
            ServicioSeeder::class,    
            ReservacionSeeder::class,
            HabitacionServicioSeeder::class,  
        ]);
    }
}