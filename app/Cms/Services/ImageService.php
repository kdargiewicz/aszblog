<?php

namespace App\Cms\Services;

use App\Constants\Constants;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Cms\DTO\ImageDTO;
use App\Cms\Repositories\ImageRepository;
use JsonException;

class ImageService
{
    protected ImageManager $manager;
    protected ImageRepository $repository;

    public function __construct()
    {
        $this->repository = app(ImageRepository::class);
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * @throws JsonException
     */
    public function saveImageVersions(UploadedFile $file, int $userId, string $folder, string $typeImage = 'other', $uuid = null): array
    {
        $basePath = $userId . "/images/{$folder}";

        if (!Storage::exists($basePath)) {
            $this->ensureDirectoryWritable($userId . "/images/{$folder}");
        }

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = 'img_' . uniqid();

        $rawName = $filename . '_raw.' . $extension;
        $maxName = $filename . '_max.' . $extension;
        $minName = $filename . '_min.' . $extension;

        $rawPath = "{$basePath}/{$rawName}";
        $maxPath = "{$basePath}/{$maxName}";
        $minPath = "{$basePath}/{$minName}";

        $exif = [];

        $path = $file->getRealPath();
        if ($path && function_exists('exif_read_data')) {
            $rawExif = @exif_read_data($path);
            $exif = is_array($rawExif) ? $this->sanitizeExif($rawExif) : [];
        }

        $rawImage = $this->manager->read($file)->scale(width: Constants::RAW_IMG);
        Storage::put($rawPath, (string) $rawImage->encode());

        $maxImage = $this->manager->read($file)->scale(width: Constants::MAX_IMG);
        Storage::put($maxPath, (string) $maxImage->encode());

        $minImage = $this->manager->read($file)->scale(width: Constants::MIN_IMG);
        Storage::put($minPath, (string) $minImage->encode());

        $dto = new ImageDTO(
            user_id: $userId,
            article_id: null,
            article_uuid: $uuid,
            original_name: $originalName,
            stored_name: $filename,
            url: Storage::url($maxPath),
            exif: $exif,
            extension: $extension,
            type: $typeImage,
        );

        $this->repository->store($dto);

        return [
            'raw' => Storage::url($rawPath),
            'max' => Storage::url($maxPath),
            'min' => Storage::url($minPath),
        ];
    }

    protected function sanitizeExif(array $exif): array
    {
        return [
            'camera_make'        => $exif['Make'] ?? null,
            'camera_model'       => $exif['Model'] ?? null,
            'aperture_value'     => $exif['ApertureValue'] ?? null,
            'f_number'           => $exif['FNumber'] ?? null,
            'exposure_time'      => $exif['ExposureTime'] ?? null,
            'iso'                => $exif['ISOSpeedRatings'] ?? null,
            'focal_length'       => $exif['FocalLength'] ?? null,
            'date_taken'         => $exif['DateTimeOriginal'] ?? null,
            'gps_latitude'       => $this->extractGps($exif, 'GPSLatitude', 'GPSLatitudeRef'),
            'gps_longitude'      => $this->extractGps($exif, 'GPSLongitude', 'GPSLongitudeRef'),
        ];
    }

    protected function extractGps(array $exif, string $coordKey, string $refKey): ?float
    {
        if (!isset($exif[$coordKey], $exif[$refKey])) {
            return null;
        }

        $coord = $exif[$coordKey];
        $ref = $exif[$refKey];

        $degrees = $this->gpsToFloat($coord);
        if ($degrees === null) {
            return null;
        }

        return in_array($ref, ['S', 'W']) ? -$degrees : $degrees;
    }

    protected function gpsToFloat(array $coord): ?float
    {
        if (count($coord) !== 3) {
            return null;
        }

        list($deg, $min, $sec) = $coord;

        return $this->parseExifRational($deg) + ($this->parseExifRational($min) / 60) + ($this->parseExifRational($sec) / 3600);
    }

    protected function parseExifRational($value): float
    {
        if (is_string($value) && str_contains($value, '/')) {
            [$numerator, $denominator] = explode('/', $value);
            return (float) $numerator / max((float) $denominator, 1);
        }

        return (float) $value;
    }

    public function ensureDirectoryWritable(string $relativePath): void
    {
        $fullPath = storage_path('app/public/' . $relativePath);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0775, true);
        }

        chmod($fullPath, 0775);
    }
}


