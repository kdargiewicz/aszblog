<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string|null $url
 */
class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'user_id',
        'article_id',
        'article_uuid',
        'original_name',
        'stored_name',
        'url',
        'exif',
        'extension',
        'type',
        'is_main_photo',
    ];

    protected $appends = ['url_min'];// ['url_max', 'url_min'];

    protected $casts = [
        'exif' => 'array',
    ];

    protected function buildGalleryQuery(array $publishedStatus, bool $withCategorySlug = true): \Illuminate\Database\Eloquent\Builder
    {
        $query = self::query()
            ->join('articles', 'images.article_id', '=', 'articles.id')
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->whereIn('articles.is_published', $publishedStatus)
            ->select([
                'images.*',
                'articles.slug as article_slug',
            ]);

        if ($withCategorySlug) {
            $query->join('categories', 'articles.category_id', '=', 'categories.id')
                ->addSelect('categories.slug as category_slug');
        }

        return $query;
    }

    public function getAllImagesToGallery(): array
    {
        return $this
            ->buildGalleryQuery([Constants::PUBLISHED], true)
            ->get()
            ->toArray();
    }

    public function getAllImagesFromArticles(): array
    {
        return DB::table('articles')
            ->leftJoin('images', 'articles.id', '=', 'images.article_id')
            ->where('articles.user_id', '=', auth()->id())
            ->whereIn('articles.is_published', [Constants::PUBLISHED, Constants::NOT_DELETED])
            ->select(
                'articles.id as article_id',
                'articles.title as article_title',
                'articles.is_published as article_is_published',
                'images.id as imageId',
                'images.url as imageUrl',
                'images.is_main_photo as is_main_photo',
            )
            ->orderBy('articles.id')
            ->get()
            ->groupBy('article_id')
            ->toArray();
    }

    public function getAllPreviewImagesToGallery(): array
    {
        return $this
            ->buildGalleryQuery(Constants::PUBLISHED_STATES, false)
            ->get()
            ->toArray();
    }


    public function getUrlMinAttribute(): array|string|null
    {
        return preg_replace('/(_max)?(\.\w+)$/', '_min$2', $this->url);
    }

    public function existsImageOnArticle($imageId, $articleId, $userId): bool
    {
        return DB::table('images')
            ->where('id', $imageId)
            ->where('article_id', $articleId)
            ->where('user_id', $userId)
            ->exists();
    }

//    public function getUrlMaxAttribute(): array|string|null
//    {
//        return preg_replace('/(_min)?(\.\w+)$/', '_max$2', $this->url);
//    }
}
