<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'avatar',
        'settings'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'settings' => 'array'
    ];
    
    /**
     * Relation avec les articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }
    
    /**
     * Relation avec les notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
    
    /**
     * Relation avec les générations IA
     */
    public function aiGenerations()
    {
        return $this->hasMany(AIGeneration::class, 'user_id');
    }
}