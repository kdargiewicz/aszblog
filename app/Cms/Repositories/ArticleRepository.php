<?php

namespace App\Cms\Repositories;

use App\Cms\CmsHelper;
use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;
use App\Cms\Models\Comments;
use App\Cms\Models\Tag;
use App\Constants\Constants;
use App\Web\Helpers\BlogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use function PHPUnit\Framework\isArray;

class ArticleRepository
{
    public function store(ArticleDTO $dto, ?int $categoryId, array $tagIds, int $userId): Article
    {
        return Article::firstOrCreate([
            'article_uuid' => $dto->article_uuid,
            ], [
                'user_id' => $userId,
                'title' => $dto->title,
                'slug' => $dto->slug,
                'category_id' => $categoryId,
                'tags_id' => $tagIds,
                'latitude' => $dto->latitude,
                'longitude' => $dto->longitude,
                'content' => $dto->content,
                'allow_comments' => $dto->allow_comments,
                'use_system_image_layout' => $dto->use_system_image_layout,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function update(Article $article, ArticleDTO $dto, ?int $categoryId, array $tagIds): void
    {
        $article->update([
            'title' => $dto->title,
            'slug' => $dto->slug,
            'category_id' => $categoryId,
            'tags_id' => $tagIds,
            'latitude' => $dto->latitude,
            'longitude' => $dto->longitude,
            'content' => $dto->content,
            'allow_comments' => $dto->allow_comments,
            'use_system_image_layout' => $dto->use_system_image_layout,
            'created_at' => $dto->created_at,
        ]);
    }

    public function getArticleById(int $articleId): Object
    {
        return DB::table('articles')->where('id', $articleId)->first();
    }

    protected function buildArticleQuery(?int $userId = null): Builder
    {
        $subImageQuery = DB::table('images')
            ->select('url')
            ->whereColumn('images.article_id', 'articles.id')
            ->orderByDesc('is_main_photo')
            ->orderBy('id')
            ->limit(1);

        $query = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
                'categories.slug as category_slug',
                DB::raw("REPLACE( ( {$subImageQuery->toSql()} ), '_max', '_min') as preview_image"),
                DB::raw("( {$subImageQuery->toSql()} ) as preview_image_max"),
            ])
            ->mergeBindings($subImageQuery);

        if ($userId !== null) {
            $query->where('articles.user_id', $userId);
        }

        return $query;
    }

    public function baseArticleQuery(int $userId): Builder
    {
        return $this->buildArticleQuery($userId);
    }

    public function getPublishedArticles(): Builder
    {
        return $this->buildArticleQuery();
    }

    public function getPublishedArticlesFromUser(int $userId): object
    {
        return $this->baseArticleQuery($userId)
            ->whereIn('articles.is_published', Constants::PUBLISHED_STATES)
            ->get();
    }

    public function getAllPublishedArticles(): object
    {
        return $this->getPublishedArticles()
            ->where('articles.is_published', Constants::PUBLISHED)
            ->get();
    }

    public function getArticleList(int $userId)
    {
        $articles = $this->baseArticleQuery($userId)
            ->paginate(config('blog.article_list.pagination'));

        $tags = app(Tag::class)->getTagsNameForUserId($userId);

        return app(CmsHelper::class)->transformWithTagNames($articles, $tags);
    }

    public function getArticleOwnerMailAndTitle(int $articleId): Object
    {
        return DB::table('articles')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->where('articles.id', $articleId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select('users.email', 'articles.title')
            ->first();
    }

    public function getArticleWithComments(int $articleId, $isPublished = null): ?object
    {
        $query = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.id', $articleId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
            ]);

        if ($isPublished !== null) {
                $query->whereIn('articles.is_published', $isPublished);
        }

        $article = $query->first();

        if ($article) {
            $tagIds = json_decode($article->tags_id, true);

            $tags = app(Tag::class)->getTagsFromArticle($tagIds)->toArray();
            $comments = app(Comments::class)->getAcceptedCommentsFromArticle($articleId);

            $article->tags = $tags;
            $article->comments = $comments;
        }

        return $article;
    }

    public function getFullArticleBySlug($categorySlug, $articleSlug): ?ArticleDTO
    {
        $article = DB::table('articles')
            ->join('categories', 'categories.id', '=', 'articles.category_id')
            ->where('articles.slug', $articleSlug)
            ->where('categories.slug', $categorySlug)
            ->where('articles.is_published', Constants::PUBLISHED)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select('articles.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->first();

        return $this->getArticleDTOByArticleId($article->id, [Constants::PUBLISHED]);
    }

    public function getArticleDTOByArticleId(int $articleId, $isPublished): null|ArticleDTO
    {
        $article = $this->getArticleWithComments($articleId, $isPublished);
        if ( !$article) {
            return null;
        }

        $image = DB::table('images')
            ->where('article_id', $articleId)
            ->where('deleted', Constants::NOT_DELETED)
            ->orderBy('created_at', 'asc')
            ->first();

        $content = $article->content ?? '';
        if ($article->use_system_image_layout) {
            $content = app(BlogHelper::class)->transformImagesToGroupedGallery($content);
        }

        return new ArticleDTO(
            article_uuid: $article->article_uuid,
            title: $article->title,
            tags: $article->tags ?? '',
            category: $article->category_name ?? '',
            latitude: $article->latitude ?? null,
            longitude: $article->longitude ?? null,
            content: $content,
            allow_comments: $article->allow_comments ?? false,
            use_system_image_layout: $article->use_system_image_layout ?? null,
            firstImageFromArticle: $image->url ?? null,
            created_at: $article->created_at ?? null,
            article_id: $articleId,
            comments: $article->comments ?? null,
            slug: $article->slug ?? null,
            category_slug: $article->category_slug ?? null,
        );
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

    public function getAllForBlogMap(): object
    {
        //tu musze zmienic pobieranie z modelu + artykuły generalnie opublikowane
        $articles = Article::select('id', 'title', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return $articles;
    }

    public function updatePublishedArticle($articleId, $userId, $publishedStatus): int
    {
        return DB::table('articles')->where('id', $articleId)->where('user_id', $userId)->update(['is_published' => $publishedStatus]);
    }

    public function getArticlesForFooter(): \Illuminate\Support\Collection
    {
        return $this->getPublishedArticles()
            ->where('articles.is_published', Constants::PUBLISHED)
            ->orderBy('updated_at', 'desc')
            ->limit(Constants::NUMBER_FOOTER_ARTICLES)
            ->get();
    }
}
