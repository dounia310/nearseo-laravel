<?php
// app/Models/User.php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'avatar',
        'business_type', 
        'business_name', 
        'business_address',
        'bio',
        'slug',
        'settings',
        'last_article_published_at',
        'weekly_reminder_sent_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'settings' => 'array',
        'last_article_published_at' => 'datetime',
        'weekly_reminder_sent_at' => 'datetime'
    ];
    
    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            $user->slug = Str::slug($user->name);
        });
        
        static::updating(function ($user) {
            if ($user->isDirty('name')) {
                $user->slug = Str::slug($user->name);
            }
        });
    }
    
    /**
     * =============================================
     * RELATIONS
     * =============================================
     */
    
    /**
     * Relation avec les articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    
    /**
     * Relation avec les notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    
    /**
     * Relation avec les générations IA
     */
    public function aiGenerations()
    {
        return $this->hasMany(AIGeneration::class);
    }
    
    /**
     * Relation avec les badges
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->withPivot('awarded_at')
                    ->withTimestamps();
    }
    
    /**
     * =============================================
     * MÉTHODES POUR LE BLOG PUBLIC
     * =============================================
     */
    
    /**
     * Obtenir le slug du blog
     */
    public function getBlogSlugAttribute()
    {
        return $this->slug;
    }
    
    /**
     * URL unique du blog de l'utilisateur (comme Blogger)
     * Exemple: /blog/jean-dupont
     */
    public function getBlogUrlAttribute()
    {
        return route('blog.user', $this->slug);
    }
    
    /**
     * Récupérer les articles publiés de l'utilisateur
     */
    public function publishedArticles()
    {
        return $this->articles()->where('status', 'published')->latest();
    }
    
    /**
     * Compter les articles publiés
     */
    public function getPublishedArticlesCountAttribute()
    {
        return $this->articles()->where('status', 'published')->count();
    }
    
    /**
     * Vérifier si l'utilisateur a un blog actif
     */
    public function hasPublishedArticles()
    {
        return $this->publishedArticlesCount > 0;
    }
}