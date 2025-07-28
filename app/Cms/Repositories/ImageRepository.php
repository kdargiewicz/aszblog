<?php

namespace App\Cms\Repositories;

use App\Cms\DTO\ImageDTO;
use App\Cms\Models\Article;
use App\Constants\Constants;
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

    public function deleteArticleImages($articleId, $userId)
    {
        return Image::where('article_id', $articleId)
                ->where('user_id', $userId)
                ->update(['deleted' => Constants::DELETED]);
    }

    public function restoreArticleImages($articleId, $userId)
    {
        return Image::where('article_id', $articleId)
            ->where('user_id', $userId)
            ->update(['deleted' => Constants::NOT_DELETED]);
    }

    public function getImagesUsedInContent(string $articleUuid, int $userId): \Illuminate\Support\Collection
    {
        $article = app(Article::class)->getArticleByUuid($articleUuid, $userId);

        $allImages = DB::table('images')
            ->where('user_id', $userId)
            ->where('article_uuid', $articleUuid)
            ->select(
                'id as imageId',
                'url as imageUrl',
                'stored_name',
                'show_in_gallery',
                'is_main_photo'
            )
            ->get();

        return $allImages->filter(function ($image) use ($article) {
            return str_contains($article->content, $image->stored_name);
        })->values();
    }

    public function setMainPhoto(int $mainImageId, int $articleId, int $userId): void
    {
        $imageModel = new Image();
        if (!$imageModel->existsImageOnArticle($mainImageId, $articleId, $userId)) {
            return;
        }

        Image::where('article_id', $articleId)
            ->where('user_id', $userId)
            ->update(['is_main_photo' => false]);

        Image::where('id', $mainImageId)
            ->where('user_id', $userId)
            ->where('article_id', $articleId)
            ->update(['is_main_photo' => true]);
    }

    public function resetShowInGallery(int $userId, int $articleId): void
    {
        Image::where('user_id', $userId)
            ->where('article_id', $articleId)
            ->update(['show_in_gallery' => false]);
    }

    public function setVisibleInGallery(int $imageId, int $userId, int $articleId): void
    {
        Image::where('id', $imageId)
            ->where('user_id', $userId)
            ->where('article_id', $articleId)
            ->update(['show_in_gallery' => true]);
    }

}

