<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->tinyInteger('deleted')
                ->default(0)
                ->comment('0 - aktywny, 10 - oznaczony jako usunięty')
                ->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
    }
};
