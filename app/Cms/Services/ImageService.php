<?php

namespace App\Cms\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Cms\DTO\ImageDTO;
use App\Cms\Repositories\ImageRepository;

class ImageService
{
    protected ImageManager $manager;
    protected ImageRepository $repository;

    public function __construct()
    {
        $this->repository = app(ImageRepository::class);
        $this->manager = new ImageManager(new Driver());
    }

    public function saveImageVersions(UploadedFile $file, int $userId, string $folder = 'articles'): array
    {
        $basePath = "userId/images/{$folder}";

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = 'img_' . now()->format('Ymd_His') . '_' . uniqid();


        // Nazwy plików
        $maxName = $filename . '_max.' . $extension;
        $minName = $filename . '_min.' . $extension;

        // Ścieżki do zapisu
        $maxPath = "{$basePath}/{$maxName}";
        $minPath = "{$basePath}/{$minName}";

        $exif = [];

        try {
            $rawExif = $this->manager->read($file)->exif();
            $exif = is_array($rawExif) ? $this->sanitizeExif($rawExif) : [];
        } catch (\Throwable $e) {
            logger()->warning('Błąd odczytu EXIF', ['msg' => $e->getMessage()]);
        }


        $maxImage = $this->manager->read($file)->scale(width: 1280);
        Storage::put($maxPath, (string) $maxImage->encode());

        $minImage = $this->manager->read($file)->scale(width: 400);
        Storage::put($minPath, (string) $minImage->encode());

        $dto = new ImageDTO(
            user_id: 1,//$userId,
            article_id: null,
            original_name: $originalName,
            stored_name: $filename,
            url: Storage::url($maxPath),
            exif: $exif,
            extension: $extension
        );

        $this->repository->store($dto);

//        //to oczywiscie do modelu / serwisu
//        $insert = [
//            'user_id' => 1,
//            'article_id' => null,
//            'original_name' => $originalName,
//            'stored_name' => $filename,
//            'url' => Storage::url($maxPath),
//            'exif' => json_encode($exif),
//            'extension' => $extension
//        ];
//
//        DB::table('images')->insert($insert);

        return [
            'max' => Storage::url($maxPath),
            'min' => Storage::url($minPath),
        ];
    }

    private function sanitizeExif(array $exif): array
    {
        return array_map(function ($value) {
            if (is_scalar($value) || is_null($value)) {
                return $value;
            }

            if (is_array($value)) {
                return $this->sanitizeExif($value);
            }

            return is_object($value) && method_exists($value, '__toString')
                ? (string)$value
                : gettype($value);
        }, $exif);
    }

}


