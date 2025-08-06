<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário admin para gerenciar o portfolio
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@portfolio.local',
            'password' => bcrypt('password123'),
        ]);

        // Executar seeders de dados do portfolio
        $this->call([
            TechnologySeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
