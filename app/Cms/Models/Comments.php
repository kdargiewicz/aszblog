<?php

namespace App\Cms\Models;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comments extends Model
{
    protected $table = 'comments';
    public $timestamps = false;
    protected $fillable = [
        'article_id',
        'content',
        'author',
        'add_date',
    ];

    public function store($data): Comments
    {
        $insert = [
            'article_id' => $data['article_id'],
            'content'    => $data['content'],
            'author'     => $data['author'],
            'add_date'   => now(),
        ];

        return $this->create($insert);
    }

    public function getAllForUser($userId): Object
    {
        return DB::table('comments')
            ->join('articles', 'comments.article_id', '=', 'articles.id')
            ->where('articles.user_id', $userId)
            ->orderByDesc('comments.add_date')
            ->select(
                'comments.*',
                'articles.title as article_title'
            )
            ->get();
    }

    public function getAcceptedCommentsFromArticle($articleId): \Illuminate\Support\Collection
    {
        return DB::table('comments')
            ->where('article_id', $articleId)
            ->where('accepted', true)
            ->where('deleted', Constants::NOT_DELETED)
            ->get();
    }
}
