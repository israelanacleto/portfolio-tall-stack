<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Contact;
use Illuminate\Console\Command;

class TestCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test CRUD operations and logging';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testando operações CRUD e logging...');

        try {
            // Test Project operations
            $this->info('📝 Testando Project CRUD...');
            
            $project = Project::create([
                'title' => 'Projeto Teste CRUD',
                'slug' => 'projeto-teste-crud',
                'short_description' => 'Descrição curta do projeto de teste',
                'description' => 'Descrição completa do projeto de teste para verificar CRUD.',
                'tech_stack' => ['php', 'laravel', 'livewire'],
                'github_url' => 'https://github.com/test/project',
                'live_url' => 'https://test-project.com',
                'featured' => false,
                'is_active' => true,
                'sort_order' => 999,
                'views' => 0,
            ]);

            $this->info("✅ Projeto criado: {$project->title} (ID: {$project->id})");

            // Update project
            $project->update([
                'title' => 'Projeto Teste CRUD - Atualizado',
                'featured' => true,
            ]);

            $this->info("✅ Projeto atualizado: {$project->title}");

            // Read operations
            $projectCount = Project::count();
            $activeProjects = Project::active()->count();
            $featuredProjects = Project::featured()->count();

            $this->info("📊 Estatísticas:");
            $this->line("   Total de projetos: {$projectCount}");
            $this->line("   Projetos ativos: {$activeProjects}");
            $this->line("   Projetos em destaque: {$featuredProjects}");

            // Test Technology operations
            $this->info('🔧 Testando Technology operations...');
            $techCount = Technology::active()->count();
            $this->info("✅ Tecnologias ativas: {$techCount}");

            // Test Contact operations
            $this->info('📧 Testando Contact operations...');
            $contact = Contact::create([
                'name' => 'Teste CRUD',
                'email' => 'teste@crud.com',
                'subject' => 'Teste de CRUD',
                'message' => 'Esta é uma mensagem de teste para CRUD.',
                'status' => 'new',
            ]);

            $this->info("✅ Contato criado: {$contact->name} (ID: {$contact->id})");

            // Cleanup test data
            $project->delete();
            $contact->delete();

            $this->info('🗑️ Dados de teste removidos');
            $this->info('🎉 Todos os testes CRUD passaram com sucesso!');

            // Test logging
            logger()->info('Teste de logging executado com sucesso via comando TestCrud');
            $this->info('📝 Teste de logging realizado');

        } catch (\Exception $e) {
            $this->error("❌ Erro durante teste CRUD: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return 1;
        }

        return 0;
    }
}
