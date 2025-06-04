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
}
