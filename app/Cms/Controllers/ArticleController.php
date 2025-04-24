<?php

namespace App\Cms\Controllers;

use App\Cms\Repositories\ArticleRepository;
use App\Cms\Requests\ArticleRequest;
use App\Cms\Services\CategoryTagResolverService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Cms\DTO\ArticleDTO;
use App\Cms\Models\Article;
use App\Cms\Models\Category;

use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function getCreateArticle(): object
    {
        $categories = Category::where('user_id', Auth::id())->get();

        return view('cms.article.main', compact('categories'));
    }

    public function getEditArticle(string $uuid, CategoryTagResolverService $resolver): object
    {
        $article = Article::where('article_uuid', $uuid)->firstOrFail();
        $categories = Category::where('user_id', Auth::id())->get();
        $dto = ArticleDTO::fromModel($article, $resolver);

        return view('cms.article.main', compact('dto', 'article', 'categories'));
    }

    public function postStoreUpdate(ArticleRequest $request, ArticleRepository $articleRepository, CategoryTagResolverService $categoryTagResolver): object
    {
        try {
            $userId = Auth::id();
            $validated = $request->validated();
            $dto = ArticleDTO::fromRequest($validated);

            $article = Article::where('article_uuid', $dto->article_uuid)
                ->where('user_id', $userId)
                ->firstOrFail();

            if ($article) {
                $categoryId = $categoryTagResolver->resolveCategoryId($dto->category, $userId);
                $tagIds = $categoryTagResolver->resolveTagIds($dto->tags, $userId);
                $articleRepository->update($article, $dto, $categoryId, $tagIds);

                return redirect()
                    ->route('article.edit', $article->article_uuid)
                    ->with('success', __('flash-messages.article-update-success'));
            }
        } catch (\Exception $e) {
            Log::error(__('log.log-error-update-article') . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => $userId,
                'data' => $request->all(),
            ]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with('error', __('flash-messages.article-update-error'));
    }


    public function postStoreArticle(ArticleRequest $request, ArticleRepository $articleRepository, CategoryTagResolverService $categoryTagResolver): object
    {
        try {
            $userId = Auth::id();
            $validated = $request->validated();
            $dto = ArticleDTO::fromRequest($validated);
            $categoryId = $categoryTagResolver->resolveCategoryId($dto->category, $userId);
            $tagIds = $categoryTagResolver->resolveTagIds($dto->tags, $userId);
            $article = $articleRepository->store($dto, $categoryId, $tagIds, $userId);

            return redirect()
                ->route('article.edit', $article->article_uuid)
                ->with([
                    'success' => __('flash-messages.article-store-success'),
                ]);
        } catch (\Exception $e) {
            DB::table('system_debug')->insert(['value' => $e->getMessage()]);

            Log::error(__('log.log-error-store-article') . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
                'data' => $request->all(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('flash-messages.article-store-error'));
        }
    }

    public function getArticleList(): object
    {
        $articleList = app(ArticleRepository::class)->getArticleList(Auth::id());

        return view('cms.article.list', compact('articleList'));
    }
}


