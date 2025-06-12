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

    public function getTagsFromPublishedArticles(): \Illuminate\Support\Collection
    {
        return DB::table('tags')
            ->join('articles', function ($join) {
                $join->on(DB::raw('JSON_CONTAINS(articles.tags_id, JSON_QUOTE(CAST(tags.id AS CHAR)))'), '=', DB::raw('1'))
                    ->whereIn('articles.is_published', Constants::PUBLISHED_STATES)
                    ->where('articles.deleted', Constants::NOT_DELETED);
            })
            ->where('tags.deleted', Constants::NOT_DELETED)
            ->select('tags.id', 'tags.name')
            ->distinct()
            ->get();

//        return DB::table($this->getTable())
//            ->where('tags.deleted', Constants::NOT_DELETED)
//            ->whereExists(function ($query) {
//                $query->select(DB::raw(1))
//                    ->from('articles')
//                    ->whereIn('articles.is_published', Constants::PUBLISHED_STATES)
//                    ->where('articles.deleted', Constants::NOT_DELETED)
//                    ->whereRaw("JSON_CONTAINS(articles.tags_id, CAST(tags.id AS JSON))");
//            })
//            ->select('tags.id', 'tags.name')
//            ->distinct()
//            ->get();
    }
}
