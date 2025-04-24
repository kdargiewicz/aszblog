<?php

namespace App\Cms;
use Illuminate\Pagination\LengthAwarePaginator;

class CmsHelper
{
    public function transformWithTagNames(LengthAwarePaginator $articles, $tags): LengthAwarePaginator
    {
        $articles->getCollection()->transform(function ($article) use ($tags) {
            $tagIds = json_decode($article->tags_id, true) ?? [];

            $article->tag_names = collect($tagIds)
                ->map(fn($id) => $tags[$id] ?? null)
                ->filter()
                ->implode(', ');

            return $article;
        });

        return $articles;
    }
}
