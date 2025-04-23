<?php

namespace App\Cms\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function getCreateArticle(): object
    {
        return view('cms.article.create-article');
    }

    public function postStoreArticle(Request $request)
    {

        dump($request->all());
        ///"_token" => "1YmL05hTx5deFWpuP1rZH3mFsZJsH62RQMfCZtAT"
        //  "title" => "tytul"
        //  "tags" => "tagi"
        //  "category" => "kategoria"
        //  "latitude" => "52.2297"
        //  "longitude" => "21.0122"
        //  "content" => "<p>opis to jest&nbsp;</p>"
        //  "allow_comments" => "1"

        $articleId = DB::table('articles')->insertGetId(['user_id' => 1,'content' => $request->get('content')]);
        dd('zapisano id: ' . $articleId);


        dump($request->all());

        //po zapisie i po edycji zrobic funkcje ktora uzupelni article_id w tabeli images bo tam musze dane zapisywac
    }
}
