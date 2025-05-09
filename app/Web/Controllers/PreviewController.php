<?php
//
//namespace App\Web\Controllers;
//
//use App\Cms\Models\Article;
//use App\Cms\Models\Image;
//use App\Cms\Models\UserSetting;
//use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\DB;
//
//class PreviewController extends Controller
//{
//    public function getPreviewBlogByBlogName($name): object
//    {
//        $articles = app(Article::class)->getAllForUser(auth()->id());
//
//        return view('web.template.' . $name . '.main', compact('articles'));
//    }
//
//    public function getPreviewArticle(int $articleId): object
//    {
//        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();
//
//        if (!$blogSettings || !$blogSettings->blog_template) {
//            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
//        }
//
//        $blogTemplate = $blogSettings->blog_template;
//
//        $article = app(Article::class)->getFullArticleById($articleId);
//
//        return view('web.template.' . $blogTemplate . '/preview/article', compact('article'));
//    }
//
//    public function getGallery() //tu mam wspólne rzeczy do podglądu -> do refaktoru przy publikacji bloga  ! ! !
//    {
//        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();
//
//        if (!$blogSettings || !$blogSettings->blog_template) {
//            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
//        }
//
//        $blogTemplate = $blogSettings->blog_template;
//
//        $images = app(Image::class)->getAllImagesToGallery();// DB::table('images')->get();
//
//
//        return view('web.template.' . $blogTemplate . '/preview/gallery', compact('images'));
//    }
//
//    public function getAboutMe() //tu mam wspólne rzeczy do podglądu -> do refaktoru przy publikacji bloga  ! ! !
//    {
//        $blogSettings = app(UserSetting::class)->getBlogOwnerSettings();
//
//        if (!$blogSettings || !$blogSettings->blog_template) {
//            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
//        }
//
//        $blogTemplate = $blogSettings->blog_template;
//
//        return view('web.template.' . $blogTemplate . '/preview/aboutMe');
//    }
//}


namespace App\Web\Controllers;

use App\Cms\Models\Article;
use App\Cms\Models\Image;
use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    public function getPreviewBlogByBlogName($name): object
    {
        $articles = app(Article::class)->getAllForUser(auth()->id());

        return view("web.template.{$name}.main", compact('articles'));
    }

    public function getPreviewArticle(int $articleId)
    {
        $article = app(Article::class)->getFullArticleById($articleId);

        return $this->viewWithBlogTemplate('preview/article', compact('article'));
    }

    public function getGallery()
    {
        $images = app(Image::class)->getAllImagesToGallery();

        return $this->viewWithBlogTemplate('preview/gallery', compact('images'));
    }

    public function getAboutMe()
    {
        return $this->viewWithBlogTemplate('preview/about-me');
    }

    private function viewWithBlogTemplate(string $subview, array $data = [])
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
}
