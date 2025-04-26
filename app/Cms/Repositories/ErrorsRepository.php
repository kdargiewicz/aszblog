<?php

namespace App\Cms\Repositories;

use Illuminate\Support\Facades\DB;

class ErrorsRepository
{
    public function getErrors(): object
    {
        return DB::table('system_errors')
            ->orderByDesc('created_at')
            ->paginate(config('blog.errors_log.pagination'));
    }

    public function getErrorById($errorId): object
    {
        return DB::table('system_errors')->where('id', $errorId)->first();
    }
}
