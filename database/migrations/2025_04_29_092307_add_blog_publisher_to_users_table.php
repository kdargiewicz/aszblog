<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('blog_publisher')
                ->default(false)
                ->after('is_editor')
                ->comment('Czy użytkownik ma prawo zarządzać ustawieniami bloga?');
            $table->boolean('deleted')
                ->default(false)
                ->after('remember_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('blog_publisher');
        });
    }
};
