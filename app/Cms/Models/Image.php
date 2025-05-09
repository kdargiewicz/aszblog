<?php

namespace App\Cms\Models;

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
        return self::query()->where('user_id', 8)->whereNotNull('article_id')->get()->toArray();
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
