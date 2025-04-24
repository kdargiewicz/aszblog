<?php

namespace App\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Web\Models\VisitModel;

class VisitController extends Controller
{
//    public function logVisit(): void
//    {
//        $userAgent = request()->userAgent();
//
//        VisitModel::create([
//            'ip'         => request()->ip(),
//            'user_agent' => $userAgent,
//            'platform'   => $this->getPlatform($userAgent),
//            'browser'    => $this->getBrowser($userAgent),
//            'url'        => request()->fullUrl(),
//        ]);
//    }

//    private function getPlatform(string $agent): string
//    {
//        $platforms = [
//            'Windows' => 'Windows',
//            'Macintosh' => 'macOS',
//            'Linux' => 'Linux',
//            'iPhone' => 'iOS',
//            'Android' => 'Android',
//        ];
//
//        foreach ($platforms as $key => $name) {
//            if (stripos($agent, $key) !== false) return $name;
//        }
//
//        return 'Unknown';
//    }
//
//    private function getBrowser(string $agent): string
//    {
//        $browsers = [
//            'Firefox' => 'Firefox',
//            'OPR' => 'Opera',
//            'Edg' => 'Edge',
//            'Chrome' => 'Chrome',
//            'Safari' => 'Safari',
//        ];
//
//        foreach ($browsers as $key => $name) {
//            if (stripos($agent, $key) !== false) return $name;
//        }
//
//        return 'Unknown';
//    }

    public function getVisit()
    {
        //licznik wizyt, odwiedzin bloga - wszystkie plus unikalne adresy ip
    }

    public function storeVisit()
    {
        //zapis
        ///Nie – jeśli nie ustawiasz ciasteczek, nie używasz LocalStorage ani nie śledzisz użytkownika między sesjami, to nie musisz pokazywać bannera RODO/cookies.
        //
        //Zapisywanie IP i user-agenta w bazie nie wymaga zgody, jeśli służy wyłącznie statystyce lub zabezpieczeniom.

        //migracja:
//        php artisan make:migration create_visits_table
        ///Schema::create('visits', function (Blueprint $table) {
        //    $table->id();
        //    $table->ipAddress('ip');
        //    $table->string('user_agent')->nullable();
        //    $table->string('platform')->nullable();
        //    $table->string('browser')->nullable();
        //    $table->string('url')->nullable();
        //    $table->timestamps();
        //});

//        model visit:
//        namespace App\Models;
//
//        use Illuminate\Database\Eloquent\Model;
//
//        class Visit extends Model
//        {
//            protected $fillable = [
//                'ip', 'user_agent', 'platform', 'browser', 'url'
//            ];
//        }

        //tu przykład kontrolera:
        ///use App\Models\Visit;
        //
        //public function logVisit(): void
        //{
        //    $userAgent = request()->userAgent();
        //
        //    Visit::create([
        //        'ip'         => request()->ip(),
        //        'user_agent' => $userAgent,
        //        'platform'   => $this->getPlatform($userAgent),
        //        'browser'    => $this->getBrowser($userAgent),
        //        'url'        => request()->fullUrl(),
        //    ]);
        //}
        //
        //private function getPlatform(string $agent): string
        //{
        //    $platforms = [
        //        'Windows' => 'Windows',
        //        'Macintosh' => 'macOS',
        //        'Linux' => 'Linux',
        //        'iPhone' => 'iOS',
        //        'Android' => 'Android',
        //    ];
        //
        //    foreach ($platforms as $key => $name) {
        //        if (stripos($agent, $key) !== false) return $name;
        //    }
        //
        //    return 'Unknown';
        //}
        //
        //private function getBrowser(string $agent): string
        //{
        //    $browsers = [
        //        'Firefox' => 'Firefox',
        //        'OPR' => 'Opera',
        //        'Edg' => 'Edge',
        //        'Chrome' => 'Chrome',
        //        'Safari' => 'Safari',
        //    ];
        //
        //    foreach ($browsers as $key => $name) {
        //        if (stripos($agent, $key) !== false) return $name;
        //    }
        //
        //    return 'Unknown';
        //}
//        i robie middleware: (w sumie nie wiem do konca o co chodzi jak to wywolywac)
//        php artisan make:middleware LogVisit
//
//    i tak moge to wywolywac w kontrolerze zeby zapisywac wizyty:
//
//        public function handle($request, Closure $next)
//    {
//        app(\App\Http\Controllers\HomeController::class)->logVisit();
//        return $next($request);
//    }

//        i teraz np mam route:
//        Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
//
//        i w tym w/w middleware dodaje:
//        protected $middlewareGroups = [
//        'web' => [
//            // ...
//            \App\Http\Middleware\LogVisit::class, // ← dodajesz tutaj
//        ],
//    ];

//        albo dla jednego route:
//        Route::get('/article/{slug}', [ArticleController::class, 'show'])
//            ->middleware('log.visit') // alias w Kernel.php
//            ->name('article.show');





        }
}
