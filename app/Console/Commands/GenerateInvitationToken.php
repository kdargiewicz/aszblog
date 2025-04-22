<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GenerateInvitationToken extends Command
{
    protected $signature = 'aszblog:generate-token --expires=24 {--expires=24 : Godzin do wygaśnięcia tokenu}';
    protected $description = 'Generuje nowy token zaproszenia do rejestracji';

    public function handle(): int
    {
        $token = Str::random(32);

        $expiresAt = now()->addHours((int) $this->option('expires'));

        DB::table('invitation_tokens')->insert([
            'code' => $token,
            'used' => false,
            'expires_at' => $expiresAt,
            'created_at' => now(),
        ]);

        $this->info("Nowy token: {$token}");
        $this->info("Wygasa: {$expiresAt->toDateTimeString()}");

        return true;
    }
}
