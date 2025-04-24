<?php

namespace App\Cms\Models;

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
}
