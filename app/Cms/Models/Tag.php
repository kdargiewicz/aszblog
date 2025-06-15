<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function getTagsNameForUserId($userId): object
    {
        return DB::table('tags')
            ->where('user_id', $userId)
            ->pluck('name', 'id');
    }

    public function getTagsFromArticle($tagIds): object
    {
        return DB::table('tags')
            ->whereIn('id', $tagIds)
            ->where('deleted', Constants::NOT_DELETED)
            ->select('id', 'name')
            ->get();
    }

    public function getTagsFromPublishedArticles(): \Illuminate\Support\Collection|null
    {
        $allTagIds = [];
        $publishedArticles =  DB::table('articles')
            ->where('articles.is_published', Constants::PUBLISHED)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->get();

        if ($publishedArticles) {
            foreach ($publishedArticles as $article) {
                $tagIds = json_decode($article->tags_id);
                if (is_array($tagIds)) {
                    foreach ($tagIds as $tagId) {
                        $allTagIds[] = $tagId;
                    }
                }
            }

            $allTagIds = array_unique($allTagIds);

            return DB::table('tags')
                ->whereIn('id', $allTagIds)
                ->get();
        }

        return null;
    }
}
