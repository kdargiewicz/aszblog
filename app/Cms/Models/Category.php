<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function getCategoriesFromPublishedArticles(): \Illuminate\Support\Collection
    {
        return DB::table($this->getTable())
            ->join('articles', 'articles.category_id', '=', 'categories.id')
            ->where('categories.deleted', Constants::NOT_DELETED)
            ->where('articles.deleted', Constants::NOT_DELETED)
            ->whereIn('articles.is_published', Constants::PUBLISHED_STATES)
            ->select('categories.id', 'categories.name')
            ->distinct()
            ->get();
    }
}
