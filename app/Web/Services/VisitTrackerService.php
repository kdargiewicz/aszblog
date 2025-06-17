<?php

namespace App\Web\Services;

use App\Web\Models\VisitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VisitTrackerService
{
    public function __construct(private VisitModel $visitModel) {}

    public function getAllData()
    {
        return $this->visitModel->getAllData();
    }

    public function getBrowserStats()
    {
        return $this->visitModel->getBrowserStats();
    }

    public function getWeekdayStats()
    {
        return $this->visitModel->getWeekdayStats();
    }

    public function getTypeStats()
    {
        return $this->visitModel->getTypeStats();
    }

    public function getUrlStats()
    {
        return $this->visitModel->getUrlStats();
    }

    public function getBrowserStatsByTopUrls(): array
    {
        return $this->visitModel->getBrowserStatsByTopUrls();
    }

    public function getCountAllVisit(): int
    {
        return $this->visitModel->getAll();
    }

    public function logVisit(Request $request, ?string $type = null, ?int $modelId = null): void
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $url = $request->fullUrl();

        $cacheKey = 'visit_' . md5($ip . $userAgent . $url);

        if (Cache::has($cacheKey)) {
            return;
        }

        VisitModel::create([
            'ip'         => $ip,
            'user_agent' => $userAgent,
            'platform'   => $this->getPlatform($userAgent),
            'browser'    => $this->getBrowser($userAgent),
            'url'        => $url,
            'type'       => $type,
            'model_id'   => $modelId,
        ]);

        Cache::put($cacheKey, true, now()->addMinutes(10));
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

