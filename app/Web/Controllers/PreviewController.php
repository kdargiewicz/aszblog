<?php

namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    public function getPreviewBlogByBlogName($name): object
    {
        return view('web.template.' . $name . '.main');
    }

    public function getPreviewArticle(int $articleId): object
    {
        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();

        if (!$blogSettings || !$blogSettings->blog_template) {
            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
        }

        $blogTemplate = $blogSettings->blog_template;

        $article = app(Article::class)->getByArticleId($articleId);

        return view('web.template.' . $blogTemplate . '/preview/article')->with('article', $article);
    }
}
