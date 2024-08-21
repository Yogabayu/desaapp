<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'article_id',
        'name',
        'email',
        'comment',
        'status',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    
}
