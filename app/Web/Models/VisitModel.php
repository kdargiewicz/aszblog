<?php

namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getAll(): int
    {
        return DB::table($this->table)->get()->count();
    }

    public function getAllData()
    {
        return DB::table($this->table)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get()
            ->sortBy('date');
    }

    public function getBrowserStats()
    {
        return  DB::table($this->table)
            ->select('browser', DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(7)
            ->get();
    }

    public function getWeekdayStats()
    {
        return DB::table('visits_logger')
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->get();
    }

    public function getTypeStats()
    {
        return DB::table('visits_logger')
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();
    }

    public function getUrlStats()
    {
        return DB::table('visits_logger')
            ->select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(10) // ogranicz do najczęściej odwiedzanych (dla czytelności wykresu)
            ->get();

    }

    public function getBrowserStatsByTopUrls(int $limit = 5): array
    {
        $topUrls = DB::table('visits_logger')
            ->select('url')
            ->groupBy('url')
            ->orderByRaw('COUNT(*) DESC')
            ->limit($limit)
            ->pluck('url');

        $browserStatsByUrl = DB::table('visits_logger')
            ->select('url', 'browser', DB::raw('count(*) as total'))
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
