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
    ];

    protected $appends = ['url_min'];// ['url_max', 'url_min'];

    protected $casts = [
        'exif' => 'array',
    ];

    protected function buildGalleryQuery(array $publishedStatus, bool $withCategorySlug = true)
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

//    public function getUrlMaxAttribute(): array|string|null
//    {
//        return preg_replace('/(_min)?(\.\w+)$/', '_max$2', $this->url);
//    }
}
