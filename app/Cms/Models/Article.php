<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'user_id',
        'article_uuid',
        'title',
        'tags_id',
        'category_id',
        'latitude',
        'longitude',
        'content',
        'allow_comments',
    ];

    protected $casts = [
        'tags_id' => 'array',
    ];

    public function getArticleId(): int
    {
        return $this->getAttribute('id');
    }

    public function getArticleUuid(): string
    {
        return $this->getAttribute('article_uuid');
    }

    public function getByArticleId(int $articleId): object
    {
        return DB::table($this->table)->where('id', $articleId)->first();
    }

}
