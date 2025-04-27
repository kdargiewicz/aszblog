<?php

namespace App\View\Composers;

use App\Cms\Models\UserSetting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserAvatarComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();
        $avatar = null;
        $settings = app(UserSetting::class)->getUserSettings($user->id);

        if ($user && $settings) {
            $avatar = $settings->avatar;
        }

        $view->with('userAvatar', $avatar);
    }
}
