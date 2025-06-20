<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static UserSetting updateOrCreate(array $attributes, array $values = [])
 * @method static Builder|UserSetting where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static UserSetting|null first()
 * @method static UserSetting firstOrFail()
 * @method static UserSetting find($id)
 * @method static \Illuminate\Database\Eloquent\Collection|UserSetting[] all()
 * @mixin Builder
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
        'about_me_image',
        'main_colors',
        'show_article_sidebar',
    ];

    protected $casts = [
        'main_colors' => 'array',
    ];

    public function getUserSettings($userId): ?UserSetting
    {
        return UserSetting::where('user_id', $userId)->first();
    }

    public function postUpdateSettings($userId, $update): int
    {
        return DB::table('user_settings')->where('user_id', $userId)->update($update);
    }

    public function postRestoreColors($userId): int
    {
        return DB::table('user_settings')
            ->where('user_id', $userId)
            ->update([
                'main_colors' => json_encode(config('blog.default_colors')),
            ]);
    }

    public function getBlogOwnerSettings(): ?object
    {
        $userId = DB::table('settings')
            ->where('key', 'blog_owner_user_id')
            ->value('value');

        if (!$userId) {
            return null;
        }

        return UserSetting::where('user_id', $userId)->first();
    }

    public function getBlogPublishedStatus(): ?int
    {
        $publishedStatusBlog = DB::table('settings')
            ->where('key', 'the_blog_is_public')
            ->value('value');

        if (!$publishedStatusBlog) {
            return null;
        }

        return $publishedStatusBlog;
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

    public function getBlogStatus(): bool
    {
        $blogStatus = (int) DB::table('settings')
            ->where('key', 'the_blog_is_public')
            ->value('value') ?? 0;

        if ($blogStatus === Constants::BLOG_IS_PUBLISHED){
            return true;
        } else {
            return false;
        }
    }
}
