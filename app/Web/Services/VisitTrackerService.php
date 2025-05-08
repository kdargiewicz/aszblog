<?php

namespace App\Web\Services;

use App\Web\Models\VisitModel;
use Illuminate\Http\Request;

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

    public function getBrowserStatsByTopUrls()
    {
        return $this->visitModel->getBrowserStatsByTopUrls();
    }

    public function getCountAllVisit(): int
    {
        return $this->visitModel->getAll();
    }

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

