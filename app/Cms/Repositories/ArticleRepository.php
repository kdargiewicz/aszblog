<?php

namespace App\Cms\Repositories;

use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;

class ArticleRepository
{
    public function store(ArticleDTO $dto, int $categoryId, array $tagIds, int $userId): Article
    {
        $article = Article::firstOrCreate([
            'article_uuid' => $dto->article_uuid,
        ], [
            'user_id'        => $userId,
            'title'          => $dto->title,
            'category_id'    => $categoryId,
            'tags_id'        => $tagIds,
            'latitude'       => $dto->latitude,
            'longitude'      => $dto->longitude,
            'content'        => $dto->content,
            'allow_comments' => $dto->allow_comments,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return $article;
    }

    public function update(Article $article, ArticleDTO $dto, int $categoryId, array $tagIds): void
    {
        $article->update([
            'title'          => $dto->title,
            'category_id'    => $categoryId,
            'tags_id'        => $tagIds,
            'latitude'       => $dto->latitude,
            'longitude'      => $dto->longitude,
            'content'        => $dto->content,
            'allow_comments' => $dto->allow_comments,
        ]);
    }
}
