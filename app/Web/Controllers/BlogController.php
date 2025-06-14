<?php

namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function welcome(): object
    {
        if (!app(UserSetting::class)->getBlogPublishedStatus()) {
            return view('welcome');
        }

        return $this->getBlog();
    }

    public function getBlog(): object
    {
        $selectedBlogName = app(UserSetting::class)->getBlogOwnerSettings()->blog_template;
        $publishedArticles = app(Article::class)->getAllPublishedArticles();

        return view("blog.template.{$selectedBlogName}.main", ['articles' => $publishedArticles]);
    }

}
