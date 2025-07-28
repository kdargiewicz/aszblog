<?php

namespace App\Console\Commands;

use App\Cms\Models\Article;
use App\Cms\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * php artisan app:fix-command add-articles-slugs
     * php artisan app:fix-command fix-articles-gallery
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
            'fix-articles-gallery' => $this->fixArticlesGallery(),
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

    private function fixArticlesGallery(): void
    {
        $articles = DB::table('articles')
            ->where('content', 'like', '%<div class="image-row"%')
            ->select('id', 'content')
            ->get();

        foreach ($articles as $article) {
            $content = $article->content;

            $doc = new \DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

            $xpath = new \DOMXPath($doc);
            $divs = $xpath->query('//div[contains(@class, "image-row")]');

            foreach ($divs as $div) {
                $parent = $div->parentNode;

                while ($div->firstChild) {
                    $parent->insertBefore($div->firstChild, $div);
                }
                $parent->removeChild($div);
            }

            $body = $doc->getElementsByTagName('body')->item(0);
            $newContent = '';
            foreach ($body->childNodes as $child) {
                $newContent .= $doc->saveHTML($child);
            }

            DB::table('articles')
                ->where('id', $article->id)
                ->update(['content' => $newContent]);

            $this->line("Zaktualizowano artykuł: {$article->id}");
        }

    }
}
