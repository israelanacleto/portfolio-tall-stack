<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Portfolio TALL Stack',
                'slug' => 'portfolio-tall-stack',
                'description' => 'Portfolio profissional desenvolvido com TALL Stack (Tailwind, Alpine.js, Laravel, Livewire). Inclui sistema de gerenciamento de projetos, dark mode, upload de imagens e full-text search otimizado para PostgreSQL.',
                'short_description' => 'Portfolio profissional com TALL Stack e PostgreSQL',
                'tech_stack' => ['php', 'laravel', 'livewire', 'tailwindcss', 'alpinejs', 'postgresql', 'docker'],
                'metadata' => [
                    'development_time' => '2 semanas',
                    'highlights' => ['Dark mode', 'PostgreSQL otimizado', 'Full-text search', 'Docker'],
                    'challenges' => 'Implementação de UUID como primary key e otimização para PostgreSQL'
                ],
                'github_url' => 'https://github.com/seu-usuario/portfolio-tall-stack',
                'live_url' => null,
                'featured' => true,
                'views' => 0,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema E-commerce .NET',
                'slug' => 'ecommerce-dotnet',
                'description' => 'Sistema completo de e-commerce desenvolvido em .NET Core com Entity Framework. Inclui carrinho de compras, sistema de pagamento, gestão de produtos, painel administrativo e relatórios de vendas.',
                'short_description' => 'E-commerce completo com .NET Core e Entity Framework',
                'tech_stack' => ['csharp', 'dotnet', 'entityframework', 'sqlserver', 'bootstrap'],
                'metadata' => [
                    'development_time' => '3 meses',
                    'highlights' => ['Pagamento integrado', 'Relatórios', 'Painel admin', 'Gestão de estoque'],
                    'features' => ['Carrinho de compras', 'Checkout', 'Histórico de pedidos', 'Gestão de usuários']
                ],
                'github_url' => 'https://github.com/seu-usuario/ecommerce-dotnet',
                'live_url' => null,
                'featured' => true,
                'views' => 0,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Dashboard Angular Analytics',
                'slug' => 'dashboard-angular-analytics',
                'description' => 'Dashboard interativo para análise de dados desenvolvido com Angular. Possui gráficos dinâmicos, filtros avançados, exportação de relatórios e integração com API REST. Interface responsiva e moderna.',
                'short_description' => 'Dashboard analytics com Angular e gráficos interativos',
                'tech_stack' => ['angular', 'typescript', 'chartjs', 'bootstrap', 'rxjs'],
                'metadata' => [
                    'development_time' => '1 mês',
                    'highlights' => ['Gráficos interativos', 'Filtros avançados', 'Exportação PDF', 'Real-time'],
                    'libraries' => ['Chart.js', 'RxJS', 'Angular Material', 'NgBootstrap']
                ],
                'github_url' => 'https://github.com/seu-usuario/dashboard-angular',
                'live_url' => 'https://dashboard-demo.exemplo.com',
                'featured' => false,
                'views' => 0,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'API REST Laravel com JWT',
                'slug' => 'api-laravel-jwt',
                'description' => 'API REST robusta desenvolvida em Laravel com autenticação JWT. Inclui documentação Swagger, rate limiting, cache Redis, testes automatizados e deploy automatizado com GitHub Actions.',
                'short_description' => 'API REST Laravel com JWT e documentação Swagger',
                'tech_stack' => ['php', 'laravel', 'jwt', 'swagger', 'redis', 'postgresql'],
                'metadata' => [
                    'development_time' => '3 semanas',
                    'highlights' => ['JWT Auth', 'Swagger Docs', 'Rate Limiting', 'Cache Redis'],
                    'features' => ['CRUD completo', 'Paginação', 'Filtros', 'Validation', 'Error handling']
                ],
                'github_url' => 'https://github.com/seu-usuario/api-laravel-jwt',
                'live_url' => null,
                'featured' => false,
                'views' => 0,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema Gestão Escolar',
                'slug' => 'sistema-gestao-escolar',
                'description' => 'Sistema completo de gestão escolar desenvolvido para facilitar a administração de instituições de ensino. Inclui gestão de alunos, professores, turmas, notas e frequência.',
                'short_description' => 'Sistema de gestão escolar com PHP e MySQL',
                'tech_stack' => ['php', 'mysql', 'javascript', 'bootstrap', 'jquery'],
                'metadata' => [
                    'development_time' => '4 meses',
                    'highlights' => ['Gestão completa', 'Relatórios', 'Boletim online', 'Multi-perfil'],
                    'modules' => ['Alunos', 'Professores', 'Turmas', 'Notas', 'Frequência', 'Financeiro']
                ],
                'github_url' => 'https://github.com/seu-usuario/gestao-escolar',
                'live_url' => null,
                'featured' => false,
                'views' => 0,
                'sort_order' => 5,
                'is_active' => true,
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }
}
