<?php

namespace App\Web\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function storeComment(Request $request)
    {
        $data = $request->validate([
        'article_id' => 'required|exists:articles,id',
        'author'     => 'required|string|max:255',
        'content'    => 'required|string|max:5000',
    ]);

        $insert = [
            'article_id' => $data['article_id'],
            'content'    => $data['content'],
            'author'     => $data['author'],
            'add_date'   => now(),
        ];

        // Tworzymy komentarz, add_date ustawiane w modelu
        DB::table('comments')->insert($insert);

        return redirect()->back()
            ->with('success', __('flash-messages.add_comment'));
    }
}
