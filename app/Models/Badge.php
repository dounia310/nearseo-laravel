<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'condition_type',
        'condition_value',
        'is_automatic'
    ];
    
    protected $casts = [
        'condition_value' => 'integer',
        'is_automatic' => 'boolean'
    ];
    
    /**
     * Relation avec les utilisateurs
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
                    ->withPivot('awarded_at')
                    ->withTimestamps();
    }
}