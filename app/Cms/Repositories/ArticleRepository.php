<?php

namespace App\Cms\Repositories;

use App\Cms\CmsHelper;
use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;
use App\Cms\Models\Tag;
use App\Constants\Constants;
use Illuminate\Support\Facades\DB;

class ArticleRepository
{
    public function store(ArticleDTO $dto, ?int $categoryId, array $tagIds, int $userId): Article
    {
        $article = Article::firstOrCreate([
            'article_uuid' => $dto->article_uuid,
        ], [
            'user_id' => $userId,
            'title' => $dto->title,
            'category_id' => $categoryId,
            'tags_id' => $tagIds,
            'latitude' => $dto->latitude,
            'longitude' => $dto->longitude,
            'content' => $dto->content,
            'allow_comments' => $dto->allow_comments,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $article;
    }

    public function update(Article $article, ArticleDTO $dto, ?int $categoryId, array $tagIds): void
    {
        $article->update([
            'title' => $dto->title,
            'category_id' => $categoryId,
            'tags_id' => $tagIds,
            'latitude' => $dto->latitude,
            'longitude' => $dto->longitude,
            'content' => $dto->content,
            'allow_comments' => $dto->allow_comments,
        ]);
    }

    public function getArticleList(int $userId)
    {
        $articles = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.user_id', $userId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select('articles.*', 'categories.name as category_name')
            ->paginate(config('blog.article_list.pagination'));

        $tags = app(Tag::class)->getTagsNameForUserId($userId);
        $articlesWithTagNames = app(CmsHelper::class)->transformWithTagNames($articles, $tags);

        return $articlesWithTagNames;
    }

    public function deleteArticle($articleId, $userId): int
    {
        return DB::table('articles')->where('user_id', $userId)->where('id', $articleId)->update(['deleted' => Constants::DELETED]);
    }

    public function getDeleteArticleList(int $userId): \Illuminate\Pagination\LengthAwarePaginator
    {
        return DB::table('articles')
            ->where('user_id', $userId)
            ->where('deleted', Constants::DELETED)
            ->paginate(config('blog.article_list.pagination'));
    }

    public function restoreArticle(int $articleId, $userId): int
    {
        return DB::table('articles')->where('user_id', $userId)->where('id', $articleId)->update(['deleted' => Constants::NOT_DELETED]);
    }

}
