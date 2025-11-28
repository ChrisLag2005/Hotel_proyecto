<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
       
        if (!User::where('email', 'admin@hotel.com')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@hotel.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            $this->command->info('Usuario admin creado: admin@hotel.com / admin123');
        } else {
            $this->command->info('El usuario admin ya existe');
        }
    }
}