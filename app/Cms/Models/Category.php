<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'user_id',
        'name',
    ];
}
