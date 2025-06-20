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

    public function getAllImagesToGallery(): array
    {
        return self::query()
            ->join('articles', 'images.article_id', '=', 'articles.id')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->where('articles.is_published', Constants::PUBLISHED)
            ->select([
                'images.*',
                'articles.slug as article_slug',
                'categories.slug as category_slug',
            ])
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
