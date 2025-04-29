<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'main_image',
        'about_me',
        'my_motto',
        'blog_template',
    ];

    public function getUserSettings($userId): object|null
    {
        return DB::table('user_settings')->where('user_id', $userId)->first();
    }

    public function postUpdateSettings($userId, $update): int
    {
        return DB::table('user_settings')->where('user_id', $userId)->update($update);
    }

    public function getBlogOwnerSettings(): ?object
    {
        $userId = DB::table('settings')
            ->where('key', 'blog_owner_user_id')
            ->value('value');

        if (!$userId) {
            return null;
        }

        return DB::table('user_settings')
            ->where('user_id', $userId)
            ->first();
    }
}
