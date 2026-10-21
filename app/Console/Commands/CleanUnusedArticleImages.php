<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Description('Clean up unused article images from storage.')]
#[Signature('app:clean-unused-article-images')]
class CleanUnusedArticleImages extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Scanning all articles for used images...');
        Log::info('[Image Cleanup] Started scanning articles for used images.');

        $usedImages = [];

        DB::table('articles')->select('content')->orderBy('uuid')->chunk(100, function ($articles) use (&$usedImages) {
            foreach ($articles as $article) {
                preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $article->content, $matches);

                foreach ($matches[1] as $src) {
                    if (preg_match('#/article/.*#', $src, $match)) {
                        $path = ltrim($match[0], '/');
                        $usedImages[] = $path;
                    }
                }
            }
        });

        $usedImages = array_unique($usedImages);
        $usedCount = count($usedImages);
        $this->info("✅ Found {$usedCount} unique used images.");
        Log::info("[Image Cleanup] Found {$usedCount} unique used images.");

        $this->info('📂 Scanning storage for files...');
        $allFiles = Storage::allFiles('article');
        $totalFiles = count($allFiles);
        $this->info("✅ Found {$totalFiles} total files in storage.");
        Log::info("[Image Cleanup] Found {$totalFiles} total files in storage.");

        $deletedCount = 0;
        $usedImagesMap = array_flip($usedImages);

        foreach ($allFiles as $file) {
            if (! isset($usedImagesMap[$file])) {
                Storage::delete($file);
                $deletedCount++;
            }
        }

        Log::info("[Image Cleanup] Completed. Deleted {$deletedCount} unused images.");
        $this->info("🗑️  Cleanup complete! Deleted {$deletedCount} unused images.");
    }
}
