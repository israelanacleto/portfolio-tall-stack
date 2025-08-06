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
        Schema::create('project_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_id');
            $table->string('filename'); // Nome do arquivo
            $table->string('original_name'); // Nome original do upload
            $table->string('path'); // Path completo no storage
            $table->string('alt_text')->nullable();
            $table->enum('type', ['screenshot', 'logo', 'banner', 'diagram', 'other'])->default('screenshot');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false); // Imagem principal do projeto
            $table->integer('size')->nullable(); // Tamanho em bytes
            $table->string('mime_type')->nullable();
            $table->jsonb('metadata')->nullable(); // Dimensões, EXIF, etc.
            $table->timestamps();
            
            // Chave estrangeira
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            
            // Índices
            $table->index('project_id');
            $table->index(['project_id', 'sort_order']);
            $table->index(['project_id', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
