<?php

namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\Image;
use App\Cms\Models\UserSetting;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Web\Helpers\BlogHelper;

class PreviewController extends Controller
{
    public function getPreviewBlogByBlogName($name): object
    {
        $articles = app(Article::class)->getAllForUser(auth()->id());

        if ($name == 'blogy') { //tu protezka do nowego theme bloga, trzeba to ujednolicic?

            $marked = app(BlogHelper::class)->markTallArticles($articles);

            return view("web.template.{$name}.articles", ['articles' => $marked]);
        }

        return view("web.template.{$name}.main", compact('articles'));
    }

    public function getPreviewArticle(int $articleId): object
    {
        $article = app(Article::class)->getFullArticleById($articleId, Constants::PUBLISHED_STATES);

        if (!$article) {
            return redirect()->route('first.blog.preview', ['name' => 'blogy']);
        }

        return $this->viewWithBlogTemplate('preview/article', compact('article'));
    }

    public function getGallery(): object //tu powinienem zwracac zdjecia z opubikowanych artykułów? ewentualnie zrobić edycje które sie mają wyświetlac
    {
        $images = app(Image::class)->getAllImagesToGallery();

        return $this->viewWithBlogTemplate('preview/gallery', compact('images'));
    }

    public function getAboutMe(): object
    {
        return $this->viewWithBlogTemplate('preview/about-me');
    }

    public function getContact(): object
    {
        return $this->viewWithBlogTemplate('preview/contact');
    }

    private function viewWithBlogTemplate(string $subview, array $data = []): object
    {
        $blogTemplate = $this->getBlogTemplate();

        if (!$blogTemplate) {
            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
        }

        $path = "web.template.{$blogTemplate}/{$subview}";
        return view($path, $data);
    }

    private function getBlogTemplate(): ?string
    {
        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();

        if (!$blogSettings || !$blogSettings->blog_template) {
            return null;
        }

        return $blogSettings->blog_template;
    }

    public function getBlogMap()
    {
        $articles = app(Article::class)->getAllForBlogMap(auth()->id());

        return $this->viewWithBlogTemplate('preview/blog-map', compact('articles'));
    }
}
