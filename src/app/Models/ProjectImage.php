<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'project_id',
        'filename',
        'original_name',
        'path',
        'alt_text',
        'type',
        'sort_order',
        'is_featured',
        'size',
        'mime_type',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'size' => 'integer',
    ];

    // Relacionamento
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessor para URL da imagem
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
