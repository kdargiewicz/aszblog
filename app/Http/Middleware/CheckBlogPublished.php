<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Cms\Models\UserSetting;

class CheckBlogPublished
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!app(UserSetting::class)->getBlogPublishedStatus()) {
            return response()->view('welcome');
        }

        return $next($request);
    }
}

