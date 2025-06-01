<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Backup;

class BackupMakeCommand extends Command
{
    //docker compose exec app php artisan backup:make --user_id=1
    protected $signature = 'backup:make {--user_id=}';
    protected $description = 'Backup bazy danych i folderu storage';

    public function handle()
    {
        $userId = $this->option('user_id') ?? null;

        $timestamp = now()->format('Y-m-d_H-i-s');
        $basePath = storage_path('app/backups');
        File::ensureDirectoryExists($basePath);

        $sqlFile = "db_backup_{$timestamp}.sql";
        $zipFile = "storage_backup_{$timestamp}.zip";
        $finalArchive = "full_backup_{$timestamp}.zip";

        $db = config('database.connections.mysql');
        $cmd = "mysqldump -u{$db['username']} -p\"{$db['password']}\" -h{$db['host']} {$db['database']} > {$basePath}/{$sqlFile}";
        $this->info("Wykonuję backup bazy...");
        exec($cmd, $output, $result);
        if ($result !== 0) {
            $this->error("Błąd przy backupie bazy danych");
            return Command::FAILURE;
        }

        $this->info("Pakuję folder storage...");
        $zipPath = "{$basePath}/{$zipFile}";
        $storagePath = storage_path();
        exec("cd {$storagePath} && zip -r {$zipPath} .");

        $this->info("Tworzę finalne archiwum...");
        $finalPath = "{$basePath}/{$finalArchive}";
        exec("cd {$basePath} && zip {$finalArchive} {$sqlFile} {$zipFile}");

        File::delete("{$basePath}/{$sqlFile}");
        File::delete("{$basePath}/{$zipFile}");

        Backup::create([
            'user_id' => $userId,
            'file_name' => $finalArchive,
            'file_path' => "storage/app/backups/{$finalArchive}",
        ]);

        $this->info("Backup zakończony (dane pliku w tabeli backups). Plik: {$finalArchive}");
        return Command::SUCCESS;
    }
}
