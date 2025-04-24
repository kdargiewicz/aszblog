<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Cms\Models\Article;

class LogVisitMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Str::contains(strtolower($request->userAgent()), ['bot', 'crawl', 'spider'])) {
            return $next($request);
        }

        $route = $request->route();
        $type = null;
        $modelId = null;

        //if ($route && in_array($route->getName(), ['article.create', 'article.show', 'article.edit'])) {

        // LUB:
        //if ($route && str_starts_with($route->getName(), 'article.')) {

        //TU DO LICZENIA WEJSC W ARTYKULY ALE POTRZEBUJE SLUG

//        if ($route && $route->getName() === 'article.create') {
//            $slug = $route->parameter('slug');
//
//            $article = Article::where('slug', $slug)->first();
//            if ($article) {
//                $type = 'article';
//                $modelId = $article->id;
//                app(\App\Web\Services\VisitTrackerService::class)->logVisit($request, $type, $modelId);
//
//                return $next($request);
//            }
//        }

        app(\App\Web\Services\VisitTrackerService::class)->logVisit($request);

        return $next($request);
    }
}
