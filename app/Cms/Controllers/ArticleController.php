<?php

namespace App\Cms\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function getCreateArticle()
    {
        //
    }

    public function postStoreArticle(Request $request)
    {
        $articleId = DB::table('articles')->insertGetId(['user_id' => 1,'content' => $request->get('content')]);
        dd('zapisano id: ' . $articleId);


        dd($request->all());

        //po zapisie i po edycji zrobic funkcje ktora uzupelni article_id w tabeli images bo tam musze dane zapisywac
    }
}
