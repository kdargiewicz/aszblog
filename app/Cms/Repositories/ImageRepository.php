<?php

namespace App\Cms\Repositories;

use App\Cms\DTO\ImageDTO;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    public function store(ImageDTO $dto): void
    {
        DB::table('images')->insert([
            'user_id'        => $dto->user_id,
            'article_id'     => $dto->article_id,
            'original_name'  => $dto->original_name,
            'stored_name'    => $dto->stored_name,
            'url'            => $dto->url,
            'exif'           => json_encode($dto->exif, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE),
            'extension'      => $dto->extension,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}

