<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'user_id',
        'name',
    ];
}
