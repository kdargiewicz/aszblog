<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemError extends Model
{
    protected $fillable = [
        'level', 'code', 'message', 'trace', 'url', 'file', 'line', 'context'
    ];

    protected $casts = [
        'context' => 'array',
    ];
}

