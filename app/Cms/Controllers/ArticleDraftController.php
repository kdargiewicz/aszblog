<?php

namespace App\Cms\Controllers;

use App\Cms\Models\ArticleDraft;
use App\Cms\Requests\ArticleDraftRequest;
use App\Http\Controllers\Controller;

class ArticleDraftController extends Controller
{
    public function autosave(ArticleDraftRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        app(ArticleDraft::class)->saveNewArticleVersion($validated['article_uuid'], auth()->id(), $validated['content']);

        return response()->json([
            'message' => 'Autosaved',
            'saved_at' => now()->toDateTimeString(),
        ]);
    }
}
