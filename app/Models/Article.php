<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'focus_keyword',
        'seo_score',
        'status',
        'published_at',
        'address',
        'latitude',
        'longitude',
        'views'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
        'seo_score' => 'integer',
        'views' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];
    
    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope pour les articles publiés
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
    
    /**
     * Scope pour les brouillons
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }
    
    /**
     * Accesseur pour le résumé
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 150);
    }
    
    /**
     * Mutateur pour générer automatiquement le slug
     */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}