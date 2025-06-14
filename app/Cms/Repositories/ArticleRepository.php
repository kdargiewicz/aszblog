<?php

namespace App\Cms\Repositories;

use App\Cms\CmsHelper;
use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;
use App\Cms\Models\Comments;
use App\Cms\Models\Tag;
use App\Constants\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class ArticleRepository
{
    public function store(ArticleDTO $dto, ?int $categoryId, array $tagIds, int $userId): Article
    {
        return Article::firstOrCreate([
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
            ->orderBy('id')
            ->limit(1);

        $query = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
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



//    public function baseArticleQuery(int $userId): Builder
//    {
//        $subImageQuery = DB::table('images')
//            ->select('url')
//            ->whereColumn('images.article_id', 'articles.id')
//            ->orderBy('id')
//            ->limit(1);
//
//        return DB::table('articles')
//            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
//            ->where('articles.user_id', $userId)
//            ->where('articles.deleted', Constants::NOT_DELETED)
//            ->select([
//                'articles.*',
//                'categories.name as category_name',
//                DB::raw("REPLACE( ( {$subImageQuery->toSql()} ), '_max', '_min') as preview_image"),
//                DB::raw("( {$subImageQuery->toSql()} ) as preview_image_max"),
//            ])
//            ->mergeBindings($subImageQuery);
//    }
//
//    public function getPublishedArticles()
//    {
//        $subImageQuery = DB::table('images')
//            ->select('url')
//            ->whereColumn('images.article_id', 'articles.id')
//            ->orderBy('id')
//            ->limit(1);
//
//        return DB::table('articles')
//            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
//            ->where('articles.deleted', Constants::NOT_DELETED)
//            ->select([
//                'articles.*',
//                'categories.name as category_name',
//                DB::raw("REPLACE( ( {$subImageQuery->toSql()} ), '_max', '_min') as preview_image"),
//                DB::raw("( {$subImageQuery->toSql()} ) as preview_image_max"),
//            ])
//            ->mergeBindings($subImageQuery);
//    }

    public function getPublishedArticlesFromUser(int $userId): object
    {
        return $this->baseArticleQuery($userId)
            ->where('articles.is_published', Constants::TEST_PUBLISHED)
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

    public function getArticleWithComments(int $articleId): Object
    {
        $article = DB::table('articles')
            ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.id', $articleId)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->select([
                'articles.*',
                'categories.name as category_name',
            ])
            ->first();

        if ($article) {
            $tagIds = json_decode($article->tags_id, true);

            $tags = app(Tag::class)->getTagsFromArticle($tagIds)->toArray();

//            DB::table('tags')
//                ->whereIn('id', $tagIds)
//                ->where('deleted', Constants::NOT_DELETED)
//                ->select('id', 'name')
//                ->get();

            $article->tags = $tags;

            $comments = app(Comments::class)->getAcceptedCommentsFromArticle($articleId);

//            DB::table('comments')
//                ->where('article_id', $articleId)
//                ->where('accepted', true)
//                ->where('deleted', Constants::NOT_DELETED)
//                ->get();

            $article->comments = $comments;
        }

        return $article;
    }

    public function getArticleDTOByArticleId(int $articleId): null|ArticleDTO
    {
        $article = $this->getArticleWithComments($articleId);
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
            article_id: $articleId,
            comments: $article->comments ?? null,
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

}
