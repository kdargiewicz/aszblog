<?php

namespace App\Providers;

use App\Cms\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PopularPostServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['web.template.*'], function ($view) {
            $popularPost = app(Tag::class)->getTagsFromPublishedArticles();
            $view->with('popularPost', $popularPost);
        });
    }

    public function register(): void
    {
        //
    }
}
