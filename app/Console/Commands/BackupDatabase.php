<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Wykonuje kopię bazy danych do pliku .sql';

    public function handle()
    {
        $db     = config('database.connections.mysql.database');
        $user   = config('database.connections.mysql.username');
        $pass   = config('database.connections.mysql.password');
        $host   = config('database.connections.mysql.host', '127.0.0.1');

        $folder = storage_path('backups');
        $filename = $db . '_backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path = $folder . '/' . $filename;

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
            $this->info("Utworzono katalog: $folder");
        }

        $this->info("Tworzenie kopii bazy do: $path");

        $command = sprintf(
            'mysqldump --no-tablespaces -h %s -u%s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($user),
            escapeshellarg($pass),
            escapeshellarg($db),
            escapeshellarg($path)
        );

        exec($command, $output, $result);

        if ($result === 0) {
            $this->info("✔ Backup zakończony sukcesem.");
        } else {
            $this->error("✖ Błąd podczas wykonywania backupu.");
        }

        return $result;
    }
}

