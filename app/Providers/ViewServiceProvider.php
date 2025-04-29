<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Cms\Models\UserSetting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['web.template.*', 'cms.settings.main'], function ($view) {
            $settings = app(UserSetting::class)->getBlogOwnerSettings();
            $view->with('blogSettings', $settings);
        });
    }

    public function register(): void
    {
        //
    }
}
