<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleDraft extends Model
{
    protected $fillable = ['article_id', 'article_uuid', 'user_id', 'content'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function saveNewArticleVersion($article_uuid, $user_id, $content): void
    {
        $lastSaveArticleVersion = DB::table('article_drafts')
            ->where('article_uuid', $article_uuid)
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->first();

        if (!$lastSaveArticleVersion || $lastSaveArticleVersion->content !== $content) {
            \App\Cms\Models\ArticleDraft::create([
                'article_uuid' => $article_uuid,
                'user_id' => $user_id,
                'content' => $content,
            ]);
        }
    }
}
