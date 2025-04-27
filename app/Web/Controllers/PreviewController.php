<?php

namespace App\Web\Controllers;

use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    public function getPreviewBlogByBlogName($name): object
    {
        return view('web.template.' . $name . '.main');
    }

    public function getPreviewArticle($articleId): object
    {
        dump($articleId);
        dd('najpierw wybierz w settings jaki template');
    }
}
