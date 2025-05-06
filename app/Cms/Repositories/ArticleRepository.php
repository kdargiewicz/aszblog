<?php

namespace App\Cms\Repositories;

use App\Cms\CmsHelper;
use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;
use App\Cms\Models\Tag;
use App\Constants\Constants;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

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

    public function getArticleById(int $articleId): Object
    {
        return DB::table('articles')->where('id', $articleId)->first();
    }

    public function getArticleAndCategoryName(int $articleId): Object
    {
        return DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.id', $articleId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
            ])
            ->first();
    }

    public function getArticleDTOByArticleId(int $articleId): null|ArticleDTO
    {
        $article = $this->getArticleAndCategoryName($articleId);
        if ( !$article) {
            return null;
        }

        $image = DB::table('images')
            ->where('article_id', $articleId)
            ->where('deleted', Constants::NOT_DELETED)
            ->orderBy('created_at', 'asc')
            ->first();

        return new ArticleDTO(
            article_uuid: $article->article_uuid,
            title: $article->title,
            tags: $article->tags ?? '',
            category: $article->category_name ?? '',
            latitude: $article->latitude ?? null,
            longitude: $article->longitude ?? null,
            content: $article->content ?? '',
            allow_comments: $article->allow_comments ?? false,
            firstImageFromArticle: $image->url ?? null,
            created_at: $article->created_at ?? null,
        );
    }

    public function getArticleList(int $userId)
    {
        $subImageQuery = DB::table('images')
            ->select('url')
            ->whereColumn('images.article_id', 'articles.id')
            ->orderBy('id')
            ->limit(1);

        $articles = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.user_id', $userId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
                DB::raw("REPLACE( ( {$subImageQuery->toSql()} ), '_max', '_min') as preview_url")
            ])
            ->mergeBindings($subImageQuery)
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

    public function getCountArticleFromUser(): int
    {
        return DB::table('articles')->where('user_id', auth()->id())->count();
    }

}
