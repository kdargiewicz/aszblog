<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Settings extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public function updateBlogPublishedSettings($key, $data): int
    {
        return DB::table('settings')->where('key', $key)->update($data);
    }
}
