<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->jsonb('tech_stack'); // Array de tecnologias
            $table->jsonb('metadata')->nullable(); // Dados flexíveis (screenshots, links extras, etc.)
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('views')->default(0);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Índices otimizados para PostgreSQL
            $table->index('slug');
            $table->index('featured');
            $table->index('is_active');
            $table->index(['created_at', 'featured']); // Índice composto
            $table->index(['sort_order', 'featured']); // Para ordenação
        });
        
        // Full-text search usando recursos nativos do PostgreSQL
        DB::statement("CREATE INDEX projects_fulltext_idx ON projects USING gin(to_tsvector('english', title || ' ' || description))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
