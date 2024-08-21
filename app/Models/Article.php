<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'village_id',
        'user_id',
        'title',
        'slug',
        'content',
        'publish_date',
        'thumbnail',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }
}
