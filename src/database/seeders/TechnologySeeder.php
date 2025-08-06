<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            // Backend
            [
                'name' => 'PHP',
                'slug' => 'php',
                'icon' => 'devicon-php-plain',
                'color' => '#777BB4',
                'category' => 'backend',
                'description' => 'Linguagem de programação server-side',
                'website_url' => 'https://www.php.net/',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'icon' => 'devicon-laravel-plain',
                'color' => '#FF2D20',
                'category' => 'backend',
                'description' => 'Framework PHP para desenvolvimento web',
                'website_url' => 'https://laravel.com/',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Livewire',
                'slug' => 'livewire',
                'icon' => 'simple-icons:livewire',
                'color' => '#4E56A6',
                'category' => 'frontend',
                'description' => 'Framework full-stack para Laravel',
                'website_url' => 'https://livewire.laravel.com/',
                'is_active' => true,
                'sort_order' => 3,
            ],
            
            // Frontend
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwindcss',
                'icon' => 'devicon-tailwindcss-plain',
                'color' => '#38B2AC',
                'category' => 'frontend',
                'description' => 'Framework CSS utility-first',
                'website_url' => 'https://tailwindcss.com/',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Alpine.js',
                'slug' => 'alpinejs',
                'icon' => 'simple-icons:alpinedotjs',
                'color' => '#8BC34A',
                'category' => 'frontend',
                'description' => 'Framework JavaScript minimalista',
                'website_url' => 'https://alpinejs.dev/',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'icon' => 'devicon-javascript-plain',
                'color' => '#F7DF1E',
                'category' => 'frontend',
                'description' => 'Linguagem de programação client-side',
                'website_url' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript',
                'is_active' => true,
                'sort_order' => 6,
            ],
            
            // Database
            [
                'name' => 'PostgreSQL',
                'slug' => 'postgresql',
                'icon' => 'devicon-postgresql-plain',
                'color' => '#336791',
                'category' => 'database',
                'description' => 'Sistema de gerenciamento de banco de dados',
                'website_url' => 'https://www.postgresql.org/',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Redis',
                'slug' => 'redis',
                'icon' => 'devicon-redis-plain',
                'color' => '#DC382D',
                'category' => 'database',
                'description' => 'Estrutura de dados em memória',
                'website_url' => 'https://redis.io/',
                'is_active' => true,
                'sort_order' => 8,
            ],
            
            // DevOps & Tools
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'icon' => 'devicon-docker-plain',
                'color' => '#2496ED',
                'category' => 'devops',
                'description' => 'Plataforma de containerização',
                'website_url' => 'https://www.docker.com/',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Git',
                'slug' => 'git',
                'icon' => 'devicon-git-plain',
                'color' => '#F05032',
                'category' => 'devops',
                'description' => 'Sistema de controle de versão',
                'website_url' => 'https://git-scm.com/',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Vite',
                'slug' => 'vite',
                'icon' => 'devicon-vitejs-plain',
                'color' => '#646CFF',
                'category' => 'frontend',
                'description' => 'Build tool moderna e rápida',
                'website_url' => 'https://vitejs.dev/',
                'is_active' => true,
                'sort_order' => 11,
            ],
            
            // Outras tecnologias relevantes
            [
                'name' => 'C#',
                'slug' => 'csharp',
                'icon' => 'devicon-csharp-plain',
                'color' => '#239120',
                'category' => 'backend',
                'description' => 'Linguagem de programação .NET',
                'website_url' => 'https://docs.microsoft.com/en-us/dotnet/csharp/',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'name' => 'Angular',
                'slug' => 'angular',
                'icon' => 'devicon-angularjs-plain',
                'color' => '#DD0031',
                'category' => 'frontend',
                'description' => 'Framework JavaScript para SPAs',
                'website_url' => 'https://angular.io/',
                'is_active' => true,
                'sort_order' => 13,
            ],
        ];

        foreach ($technologies as $tech) {
            Technology::create($tech);
        }
    }
}
