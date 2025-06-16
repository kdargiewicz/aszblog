<?php

namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\Image;
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

    private function getBlogTemplate(): ?string
    {
        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();

        if (!$blogSettings || !$blogSettings->blog_template) {
            return null;
        }

        return $blogSettings->blog_template;
    }

    public function getBlog(): object
    {
        $selectedBlogName = app(UserSetting::class)->getBlogOwnerSettings()->blog_template;
        $publishedArticles = app(Article::class)->getAllPublishedArticles();
        $markedArticles = app(BlogHelper::class)->markTallArticles($publishedArticles);

        return view("blog.template.{$selectedBlogName}.articles", ['articles' => $markedArticles]);
    }

    private function viewWithBlogTemplate(string $subview, array $data = []): object
    {
        $blogTemplate = $this->getBlogTemplate();

        if (!$blogTemplate) {
            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
        }

        $selectedBlogName = app(UserSetting::class)->getBlogOwnerSettings()->blog_template;

        $path = "blog.template.{$selectedBlogName}/{$subview}";
        return view($path, $data);
    }

    public function getViewArticle(int $articleId)
    {
        //tu powinienem sprawdzic czy artykul na pewno jest publikowany bo mozna zmodyfikowac adres w url chyba ze zrobie przyjazne linki


        $article = app(Article::class)->getFullArticleById($articleId);
        //to trzeba zrefaktoryzowac krzychu ! ! !
        //$selectedBlogName = app(UserSetting::class)->getBlogOwnerSettings()->blog_template;

        return $this->viewWithBlogTemplate('article', compact('article'));

    }

    public function getGallery(): object //tu powinienem zwracac zdjecia z opubikowanych artykułów? ewentualnie zrobić edycje które sie mają wyświetlac
    {
        $images = app(Image::class)->getAllImagesToGallery();

        return $this->viewWithBlogTemplate('gallery', compact('images'));
    }

    public function getAboutMe(): object
    {
        return $this->viewWithBlogTemplate('about-me');
    }

    public function getContact(): object
    {
        return $this->viewWithBlogTemplate('contact');
    }

    public function getBlogMap(): object
    {
        $articles = app(Article::class)->getAllPublishedArticles();

        return $this->viewWithBlogTemplate('blog-map', compact('articles'));
    }

    public function getPrivacyPolicy(): object
    {
        return $this->viewWithBlogTemplate('privacy_policy');
    }
}
