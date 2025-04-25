<?php

namespace App\Cms\Repositories;

use App\Cms\DTO\ImageDTO;
use Illuminate\Support\Facades\DB;
use App\Cms\Models\Image;

class ImageRepository
{
    public function store(ImageDTO $dto): void
    {
        DB::table('images')->insert([
            'user_id'        => $dto->user_id,
            'article_id'     => $dto->article_id,
            'article_uuid'   => $dto->article_uuid,
            'original_name'  => $dto->original_name,
            'stored_name'    => $dto->stored_name,
            'url'            => $dto->url,
            'exif'           => json_encode($dto->exif, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE),
            'extension'      => $dto->extension,
            'type'           => $dto->type,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public function assignArticleIdByUuid(string $uuid, int $articleId, int $userId): void
    {
        Image::where('article_uuid', $uuid)
            ->where('user_id', $userId)
            ->update(['article_id' => $articleId]);
    }

}

