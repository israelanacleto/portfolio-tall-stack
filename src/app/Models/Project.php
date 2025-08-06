<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'tech_stack',
        'metadata',
        'github_url',
        'live_url',
        'featured',
        'views',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'metadata' => 'array',
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'views' => 'integer',
        'sort_order' => 'integer',
    ];

    // Relacionamentos
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function featuredImage(): HasOne
    {
        return $this->hasOne(ProjectImage::class)->where('is_featured', true);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByTechnology($query, $technology)
    {
        return $query->whereJsonContains('tech_stack', $technology);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw("to_tsvector('english', title || ' ' || description) @@ plainto_tsquery('english', ?)", [$search]);
    }

    // Accessors & Mutators
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
