<?php

namespace App\Web\Helpers;

use Illuminate\Support\Collection;

class BlogHelper
{
    public function markTallArticles(Collection $articles): Collection
    {
        $count = $articles->count();

        return $articles->map(function ($item, $index) use ($count) {
            $isTall = ($index % 3 === 2) || ($index % 4 === 3) || ($index === $count - 1 && $count % 2 !== 0);

            if (is_array($item)) {
                $item['tall'] = $isTall;
            } elseif (is_object($item)) {
                $item->tall = $isTall;
            }

            return $item;
        });
    }
}
