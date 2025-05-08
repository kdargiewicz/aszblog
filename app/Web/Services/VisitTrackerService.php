<?php

namespace App\Web\Services;

use App\Web\Models\VisitModel;
use Illuminate\Http\Request;

class VisitTrackerService
{
    public function getCountAllVisit()
    {
        return app(VisitModel::class)->getAll();
    }


    //te funkcje nizej wrzucic do jednego obiektu dot charts
    public function getAllData()
    {
        return app(VisitModel::class)->getAllData();
    }

    public function getBrowserStats()
    {
        return app(VisitModel::class)->getBrowserStats();
    }

    public function getWeekdayStats()
    {
        return app(VisitModel::class)->getWeekdayStats();
    }

    public function getTypeStats()
    {
        return app(VisitModel::class)->getTypeStats();
    }


    public function getUrlStats()
    {
        return app(VisitModel::class)->getUrlStats();
    }

    public function getBrowserStatsByTopUrls()
    {
        return app(VisitModel::class)->getBrowserStatsByTopUrls();
    }
    //te funkcje WYŻEJ wrzucic do jednego obiektu dot charts

    public function logVisit(Request $request, ?string $type = null, ?int $modelId = null): void
    {
        $agent = $request->userAgent();

        VisitModel::create([
            'ip'         => $request->ip(),
            'user_agent' => $agent,
            'platform'   => $this->getPlatform($agent),
            'browser'    => $this->getBrowser($agent),
            'url'        => $request->fullUrl(),
            'type'       => $type,
            'model_id'   => $modelId,
//            'type'       => $request->get('visit_type'), //rozwiazanie tego mam w middleware LogVisitMiddleware
//            'model_id'   => $request->get('visit_model_id'),
        ]);
    }

    private function getPlatform(string $agent): string
    {
        return collect([
            'Windows' => 'Windows',
            'Macintosh' => 'macOS',
            'Linux' => 'Linux',
            'iPhone' => 'iOS',
            'Android' => 'Android',
        ])->first(fn($name, $key) => str_contains($agent, $key)) ?? 'Unknown';
    }

    private function getBrowser(string $agent): string
    {
        return collect([
            'Firefox' => 'Firefox',
            'OPR' => 'Opera',
            'Edg' => 'Edge',
            'Chrome' => 'Chrome',
            'Safari' => 'Safari',
        ])->first(fn($name, $key) => str_contains($agent, $key)) ?? 'Unknown';
    }
}

