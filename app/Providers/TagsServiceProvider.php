<?php

namespace App\Providers;

use App\Cms\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['blog.template.*', 'web.template.*'], function ($view) {
            $tags = app(Tag::class)->getTagsFromPublishedArticles();
            $view->with('tags', $tags);
        });
    }

    public function register(): void
    {
        //
    }
}
