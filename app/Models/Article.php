<?php
// app/Models/Article.php

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
        'content_json',
        'image',
        'featured_image',
        'focus_keyword',
        'meta_description',
        'seo_score',
        'seo_grade',
        'seo_details',
        'status',
        'category',
        'published_at',
        'address',
        'latitude',
        'longitude',
        'views',
        'scheduled_for',
        'scheduled_status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'seo_score' => 'integer',
        'views' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'content_json' => 'array'
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

    /**
     * Convertir le contenu HTML en JSON Editor.js
     */
    public function getContentJsonAttribute()
    {
        if ($this->attributes['content_json'] ?? null) {
            return json_decode($this->attributes['content_json'], true);
        }

        return $this->convertHtmlToEditorJs($this->content);
    }

    /**
     * Nettoyer et afficher le contenu HTML correctement
     */
    public function getDisplayContentAttribute(): string
    {
        $content = $this->content;

        // 1. Supprimer les guillemets au début et à la fin
        $content = trim($content);
        if (substr($content, 0, 1) === '"') {
            $content = substr($content, 1);
        }
        if (substr($content, -1) === '"') {
            $content = substr($content, 0, -1);
        }

        // 2. Déséchapper les caractères
        $content = stripslashes($content);

        // 3. Remplacer les \n par des sauts de ligne réels
        $content = str_replace('\\n', "\n", $content);
        $content = str_replace('\n', "\n", $content);
        $content = str_replace('\\r', "\r", $content);
        $content = str_replace('\r', "\r", $content);

        // 4. Supprimer les guillemets restants
        $content = str_replace('\"', '"', $content);
        $content = str_replace("\'", "'", $content);

        // 5. NE SUPPRIMER QUE LES "n" PROBLÉMATIQUES
        // Supprimer les "n" qui sont entre les balises (ex: >n<)
        $content = preg_replace('/>n+</', '><', $content);

        // Supprimer les "n" qui sont seuls avec des espaces
        $content = preg_replace('/\s+n\s+/', ' ', $content);

        // Supprimer les "n" en début ou fin de ligne
        $content = preg_replace('/^n\s+/', '', $content);
        $content = preg_replace('/\s+n$/', '', $content);

        // NE PAS SUPPRIMER les "n" qui font partie des mots
        // NE PAS utiliser: $content = preg_replace('/\bn\b/', '', $content);
        // NE PAS utiliser: $content = preg_replace('/n{2,}/', '', $content);

        // 6. Corriger les apostrophes manquantes
        $content = str_replace("'est", "n'est", $content);
        $content = str_replace("'hésitez", "n'hésitez", $content);
        $content = str_replace("'a", "n'a", $content);
        $content = str_replace("'y", "n'y", $content);
        $content = str_replace("'", "'", $content);

        // 7. Nettoyer les espaces multiples
        $content = preg_replace('/\s+/', ' ', $content);

        // 8. Restaurer les espaces autour des balises
        $content = preg_replace('/>\s+</', '><', $content);

        return $content;
    }
    /**
     * Convertir HTML en format Editor.js
     */
    private function convertHtmlToEditorJs($html)
    {
        if (empty($html)) {
            return ['blocks' => []];
        }

        $blocks = [];

        // Extraire le titre H1
        preg_match('/<h1[^>]*>(.*?)<\/h1>/i', $html, $h1Matches);
        if (!empty($h1Matches[1])) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h1Matches[1])),
                    'level' => 1
                ]
            ];
        }

        // Extraire les H2
        preg_match_all('/<h2[^>]*>(.*?)<\/h2>/i', $html, $h2Matches);
        foreach ($h2Matches[1] ?? [] as $h2) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h2)),
                    'level' => 2
                ]
            ];
        }

        // Extraire les H3
        preg_match_all('/<h3[^>]*>(.*?)<\/h3>/i', $html, $h3Matches);
        foreach ($h3Matches[1] ?? [] as $h3) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h3)),
                    'level' => 3
                ]
            ];
        }

        // Extraire les paragraphes
        preg_match_all('/<p[^>]*>(.*?)<\/p>/i', $html, $pMatches);
        foreach ($pMatches[1] ?? [] as $p) {
            $text = trim(strip_tags($p));
            if (!empty($text) && strlen($text) > 10) {
                $blocks[] = [
                    'type' => 'paragraph',
                    'data' => ['text' => $text]
                ];
            }
        }

        // Extraire les listes
        preg_match_all('/<ul[^>]*>(.*?)<\/ul>/is', $html, $ulMatches);
        foreach ($ulMatches[1] ?? [] as $ul) {
            preg_match_all('/<li[^>]*>(.*?)<\/li>/i', $ul, $liMatches);
            $items = array_map('trim', array_map('strip_tags', $liMatches[1] ?? []));
            if (!empty($items)) {
                $blocks[] = [
                    'type' => 'list',
                    'data' => [
                        'style' => 'unordered',
                        'items' => $items
                    ]
                ];
            }
        }

        // Extraire les images
        preg_match_all('/<img[^>]*src=["\']([^"\']*)["\'][^>]*>/i', $html, $imgMatches);
        foreach ($imgMatches[1] ?? [] as $src) {
            $blocks[] = [
                'type' => 'image',
                'data' => [
                    'file' => ['url' => $src],
                    'caption' => ''
                ]
            ];
        }

        // Si aucun bloc n'a été trouvé, ajouter un bloc par défaut
        if (empty($blocks)) {
            $text = strip_tags($html);
            if (!empty($text)) {
                $blocks[] = [
                    'type' => 'paragraph',
                    'data' => ['text' => $text]
                ];
            }
        }

        return ['blocks' => $blocks];
    }
}
