<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('slug')->unique(); 
            $table->string('icon')->nullable(); // Classe CSS do ícone ou path da imagem
            $table->string('color', 7)->nullable(); // Cor hex para badges
            $table->enum('category', ['frontend', 'backend', 'database', 'devops', 'mobile', 'design', 'other'])->default('other');
            $table->text('description')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Índices
            $table->index('category');
            $table->index('is_active'); 
            $table->index(['category', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
