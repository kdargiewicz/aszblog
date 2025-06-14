<?php

namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;
use App\Web\Helpers\BlogHelper;

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
        $markedArticles = app(BlogHelper::class)->markTallArticles($publishedArticles);

        return view("blog.template.{$selectedBlogName}.articles", ['articles' => $markedArticles]);
    }

    public function getViewArticle(int $articleId)
    {
        //tu powinienem sprawdzic czy artykul na pewno jest publikowany bo mozna zmodyfikowac adres w url chyba ze zrobie przyjazne linki
        //

        //dd($articleId);

        $article = app(Article::class)->getFullArticleById($articleId); //dd($article);
        //to trzeba zrefaktoryzowac krzychu ! ! !
        $selectedBlogName = app(UserSetting::class)->getBlogOwnerSettings()->blog_template;

        return view("blog.template.{$selectedBlogName}.article", compact('article'));

        //return $this->viewWithBlogTemplate('preview/article', compact('article'));
    }

}
