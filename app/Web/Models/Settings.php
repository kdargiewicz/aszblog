<?php

namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    public function getRecipientEmail()
    {
        return Cache::rememberForever('contact_recipient_email', function () {
            return DB::table('settings')
                ->join('users', 'users.id', '=', 'settings.value')
                ->where('settings.key', 'blog_owner_user_id')
                ->value('users.email');
        });
    }
}
