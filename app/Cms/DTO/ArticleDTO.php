<?php

namespace App\Cms\DTO;

use App\Cms\Models\Article;
use App\Cms\Services\CategoryTagResolverService;

class ArticleDTO
{
    public function __construct(
        public ?string $article_uuid = null,
        public ?string $title,
        public ?string $tags,
        public ?string $category,
        public ?float $latitude,
        public ?float $longitude,
        public ?string $content,
        public ?bool $allow_comments,
        public ?int $category_id = null,
        public ?array $tag_ids = []
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            article_uuid: $data['article_uuid'] ?? null,
            title: $data['title'] ?? null,
            tags: $data['tags'] ?? null,
            category: $data['category'] ?? null,
            latitude: isset($data['latitude']) ? floatval($data['latitude']) : null,
            longitude: isset($data['longitude']) ? floatval($data['longitude']) : null,
            content: $data['content'] ?? null,
            allow_comments: isset($data['allow_comments']) ? boolval($data['allow_comments']) : null,
        );
    }

    public static function fromModel(Article $article, CategoryTagResolverService $resolver): self
    {
        return new self(
            article_uuid: $article->article_uuid,
            title: $article->title,
            tags: $resolver->getTagNames($article->tags_id ?? []),
            category: $resolver->getCategoryName($article->category_id),
            latitude: $article->latitude,
            longitude: $article->longitude,
            content: $article->content,
            allow_comments: $article->allow_comments,
            category_id: $article->category_id,
            tag_ids: $article->tags_id
        );
    }


//    public static function fromModel(Article $article): self
//    {
//        return new self(
//            title: $article->title,
//            tags: $article->tags->pluck('name')->implode(', '), // zakładamy relację
//            category: $article->category?->name, // jeśli masz relację belongsTo
//            latitude: $article->latitude,
//            longitude: $article->longitude,
//            content: $article->content,
//            allow_comments: $article->allow_comments,
//            category_id: $article->category_id,
//            tag_ids: $article->tags->pluck('id')->toArray()
//        );
//    }
}
