<?php

namespace App\Providers;

use App\Cms\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['web.template.*'], function ($view) {
            $categories = app(Category::class)->getCategoriesFromPublishedArticles();
            $view->with('categories', $categories);
        });
    }

    public function register(): void
    {
        //
    }
}

