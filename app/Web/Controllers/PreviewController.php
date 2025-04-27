<?php

namespace App\Web\Controllers;

use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    public function getPreviewBlogByBlogName($name): object
    {
        return view('web.template.' . $name . '.main');
    }

    public function getPreviewArticle($articleId): object
    {

        $userSettings = app(UserSetting::class)->getUserSettings(auth()->id());

        $blogTemplate = $userSettings->blog_template;

        if (!$blogTemplate) {
            return back()->with('error', __('flash-messages.error.no_blog_template_settings'));
        }

        return view('web.template.' . $blogTemplate . '.main');
    }
}
