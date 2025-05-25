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
        //w tej tablicy dodaje klase .tall do obiektu w zaleznosci ile artykulow jest
        //w widoku, np dla 6 artykulow art 1, 2 i 5 sa rozciagniete w pionie
        return match ($count) {
            1 => [],
            2 => [],
            3 => [],
            4 => [2, 3],
            5 => [2],
            6 => [1, 2, 5],
            7 => [0, 6],
            8 => [2, 5],
            9 => [2, 6],
            10 => [2, 6],
            default => []
        };
    }

}
