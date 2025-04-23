<?php

namespace App\Cms\Services;

use App\Cms\Models\Category;
use App\Cms\Models\Tag;

class CategoryTagResolverService
{
    public function resolveCategoryId(?string $categoryName, $userId): ?int
    {
        if (!$categoryName) {
            return null;
        }

        return Category::firstOrCreate(
                ['name' => $categoryName],
                ['user_id' => $userId])->id;
    }

    public function resolveTagIds(?string $tagsCsv, $userId): array
    {
        if (!$tagsCsv) {
            return [];
        }

        $names = collect(explode(',', $tagsCsv))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->unique();

        return $names->map(function ($name) use ($userId) {
            return Tag::firstOrCreate(['user_id' => $userId, 'name' => $name])->id;
        })->all();
    }

    public function getCategoryName(?int $categoryId): ?string
    {
        return $categoryId
            ? Category::where('id', $categoryId)->value('name')
            : null;
    }

    public function getTagNames(array $tagIds): string
    {
        return Tag::whereIn('id', $tagIds)->pluck('name')->implode(', ');
    }
}
