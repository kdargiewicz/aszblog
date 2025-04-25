<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'exif' => 'array',
    ];
}
