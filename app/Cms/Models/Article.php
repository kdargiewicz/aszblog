<?php

namespace App\Cms\Models;

use App\Cms\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $article_uuid
 * @property string|null $title
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $content
 * @property bool|null $allow_comments
 * @property int|null $category_id
 * @property array|null $tags_id
 * @method static Article firstOrCreate(array $attributes, array $values = [])
 */
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
        'created_at',
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

    public function getFullArticleById(int $articleId, $isPublished = null): object|null
    {
        return app(ArticleRepository::class)->getArticleDTOByArticleId($articleId, $isPublished);
    }

    public function getArticleOwnerInfo($articleId)
    {
        return app(ArticleRepository::class)->getArticleOwnerMailAndTitle($articleId);
    }

    public function getAllForUser($userId): object
    {
        return app(ArticleRepository::class)->getPublishedArticlesFromUser($userId);
    }

    public function getAllPublishedArticles(): object
    {
        return app(ArticleRepository::class)->getAllPublishedArticles();
    }

    public function getAllForBlogMap($userId): object
    {
        return app(ArticleRepository::class)->getAllForBlogMap($userId);
    }

    public function getArticlesForFooter(): object
    {
        return app(ArticleRepository::class)->getArticlesForFooter();
    }

}
