<?php
// app/Models/AIGeneration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIGeneration extends Model
{
    use HasFactory;

    protected $table = 'a_i_generations';


    protected $fillable = [
        'user_id',
        'article_id',
        'prompt',
        'generated_content',
        'seo_score',
    ];

    protected $casts = [
        'seo_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
