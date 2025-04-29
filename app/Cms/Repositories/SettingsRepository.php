<?php

namespace App\Cms\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class SettingsRepository
{
    public function getBlogOwner(): ?User
    {
        $userId = DB::table('settings')
            ->where('key', 'blog_owner_user_id')
            ->value('value');

        if (!$userId) {
            return null;
        }

        return User::with('userSettings')->find($userId);
    }
}
