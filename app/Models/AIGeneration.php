<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIGeneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sujet', 'article_genere', 'tokens_utilises'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}