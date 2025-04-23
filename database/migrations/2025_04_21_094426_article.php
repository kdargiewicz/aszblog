<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('article_uuid')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('category_id')->nullable();
            $table->json('tags_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('allow_comments')->default(false);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

