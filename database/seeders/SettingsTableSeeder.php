<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'key' => 'blog_owner_user_id',
            'value' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
