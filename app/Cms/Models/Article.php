<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use App\Cms\Models\Tag;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'user_id',
        'article_uuid',
        'title',
//        'tags_id',
        'category_id',
        'latitude',
        'longitude',
        'content',
        'allow_comments',
    ];

    protected $casts = [
        'tags_id' => 'array', // 👈 to dekoduje JSON na tablicę
    ];


//    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(Tag::class, 'tags');
//    }

}
