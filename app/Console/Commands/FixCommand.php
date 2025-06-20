<?php

namespace App\Console\Commands;

use App\Cms\Models\Article;
use App\Cms\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-command {target?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $target = $this->argument('target');

        match ($target) {
            'add-categories-slugs' => $this->fixCategorySlugs(),
            'add-articles-slugs' => $this->fixArticleSlugs(),
            null => $this->runAll(),
            default => $this->error("Nieznany argument: {$target}"),
        };

        return 0;
    }

    private function fixArticleSlugs(): void
    {
        $articles = Article::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($articles as $article) {
            if (!empty($article->title)) {
                $slug = Str::slug($article->title);

                if (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                    $slug .= '-' . $article->id;
                }

                $article->slug = $slug;
                $article->save();

                $this->line("Zaktualizowano slug dla artykułu ID {$article->id}: {$slug}");
            }
        }
    }

    private function fixCategorySlugs(): void
    {
        $categories = Category::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($categories as $category) {
            if (!empty($category->name)) {
                $slug = Str::slug($category->name);

                if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                    $slug .= '-' . $category->id;
                }

                $category->slug = $slug;
                $category->save();

                $this->line("Zaktualizowano slug dla kategorii ID {$category->id}: {$slug}");
            }
        }
    }
}
