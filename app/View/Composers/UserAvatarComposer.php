<?php

namespace App\View\Composers;

use App\Cms\Models\UserSetting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserAvatarComposer
{
    public function compose(View $view): void
    {
        $userId = auth()->id();
        $avatar = null;
        $settings = app(UserSetting::class)->getUserSettings($userId);

        if ($userId && $settings) {
            $avatar = $settings->avatar;
        }

        $view->with('userAvatar', $avatar);
    }
}
