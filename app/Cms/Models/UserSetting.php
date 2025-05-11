<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static UserSetting updateOrCreate(array $attributes, array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static UserSetting|null first()
 * @method static UserSetting firstOrFail()
 * @method static UserSetting find($id)
 * @method static \Illuminate\Database\Eloquent\Collection|UserSetting[] all()
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'main_image',
        'about_me',
        'my_motto',
        'blog_template',
        'about_me_image'
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

    public function isBlogOwner($userId): bool
    {
        $userBlogOwnerId = DB::table('settings')
            ->where('key', 'blog_owner_user_id')
            ->value('value');

        if ($userId == $userBlogOwnerId){
            return true;
        } else {
            return false;
        }
    }
}
