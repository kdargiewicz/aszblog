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

