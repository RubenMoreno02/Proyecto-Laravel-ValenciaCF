<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        User::updateOrCreate(
            ['email' => 'admin@valenciacf.es'], // Si encuentra este email, no lo duplica
            [
                'name'     => 'Administrador VCF',
                'password' => Hash::make('admin1234'),
                'rol'      => 'admin',
            ]
        );

        // Visitante
        User::updateOrCreate(
            ['email' => 'visitante@valenciacf.es'], // Si encuentra este email, no lo duplica
            [
                'name'     => 'Visitante',
                'password' => Hash::make('visitante1234'),
                'rol'      => 'visitante',
            ]
        );
    }
}