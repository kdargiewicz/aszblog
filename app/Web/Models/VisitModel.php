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
}
