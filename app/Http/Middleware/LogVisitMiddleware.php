<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogVisitMiddleware
{
    /**
     * Obsługuje logowanie wizyty dla wybranych tras, z wykluczeniem botów i nieistotnych żądań.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->isSkippable($request)) {
            return $next($request);
        }

        $routeName = $request->route()?->getName();

        $routesToLog = [
            'welcome',
            'article.view',
            'blog.article',
            'blog.gallery',
            'blog.google-map',
        ];

        if (in_array($routeName, $routesToLog)) {
            app(\App\Web\Services\VisitTrackerService::class)->logVisit($request);
        }

        return $next($request);
    }

    /**
     * Sprawdza, czy żądanie powinno być pominięte (bot, ajax, json, nieistotne ścieżki).
     */
    protected function isSkippable(Request $request): bool
    {
        $userAgent = strtolower($request->userAgent());

        return
            $request->isMethod('post') ||
            $request->ajax() ||
            $request->expectsJson() ||
            Str::contains($request->path(), ['favicon.ico', 'robots.txt', 'sitemap.xml']) ||
            Str::contains($userAgent, ['bot', 'crawl', 'spider', 'slurp', 'bingpreview', 'facebookexternalhit']);
    }
}
