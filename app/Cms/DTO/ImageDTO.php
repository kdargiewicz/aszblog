<?php

namespace App\Cms\DTO;

class ImageDTO
{
    public function __construct(
        public int    $user_id,
        public ?int   $article_id,
        public ?string    $article_uuid,
        public string $original_name,
        public string $stored_name,
        public string $url,
        public array  $exif,
        public string $extension,
        public string $type,
    )
    {
    }
}
