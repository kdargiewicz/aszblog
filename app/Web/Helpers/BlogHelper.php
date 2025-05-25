<?php

namespace App\Web\Helpers;

use Illuminate\Support\Collection;

class BlogHelper
{
    public function markTallArticles(Collection $articles): Collection
    {
        $count = $articles->count();
        $tallIndexes = $this->getTallIndexesByCount($count);

        return $articles->map(function ($item, $index) use ($tallIndexes) {
            $item->tall = in_array($index, $tallIndexes);
            return $item;
        });
    }

    private function getTallIndexesByCount(int $count): array
    {
        return config("blog.articles_grid.{$count}", []);
    }
}
