<?php

namespace App\Providers;

use App\Cms\Models\Article;
use App\Cms\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['blog.template.*'], function ($view) {
            $footerArticles = app(Article::class)->getArticlesForFooter();

            $view->with('footerArticles', $footerArticles);
        });
    }

    public function register(): void
    {
        //
    }
}
