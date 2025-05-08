<?php

namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static VisitModel create(array $values = [])
 */
class VisitModel extends Model
{
    protected $table = 'visits_logger';

    protected $fillable = [
        'ip',
        'user_agent',
        'platform',
        'browser',
        'url',
        'type',
        'model_id',
    ];

    public function scopeGroupByDate($query)
    {
        return $query->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date');
    }

    public function getAll(): int
    {
        return $this->count();
    }

    public function getAllData()
    {
        return $this->groupByDate()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get()
            ->sortBy('date');
    }

    public function getBrowserStats()
    {
        return $this->select('browser', DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(7)
            ->get();
    }

    public function getWeekdayStats()
    {
        return $this->selectRaw('DAYNAME(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->get();
    }

    public function getTypeStats()
    {
        return $this->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();
    }

    public function getUrlStats()
    {
        return $this->select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
    }

    public function getBrowserStatsByTopUrls(int $limit = 5): array
    {
        $topUrls = $this->select('url')
            ->groupBy('url')
            ->orderByRaw('COUNT(*) DESC')
            ->limit($limit)
            ->pluck('url');

        $browserStatsByUrl = $this->select('url', 'browser', DB::raw('count(*) as total'))
            ->whereIn('url', $topUrls)
            ->groupBy('url', 'browser')
            ->get()
            ->groupBy('browser');

        return [
            'topUrls' => $topUrls,
            'browserStatsByUrl' => $browserStatsByUrl,
        ];
    }
}
