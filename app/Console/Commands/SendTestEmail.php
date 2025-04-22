<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DTO\ContactMessageDTO;
use App\Mail\Controllers\ContactController;

class SendTestEmail extends Command
{
    protected $signature = 'aszblog:send-email';
    protected $description = 'Wysyła testowego maila na podany adres';

    public function handle(): int
    {
        $dto = new ContactMessageDTO(
            name: 'System AszBlog',
            email: 'noreply@aszblog.pl',
            message: 'Twój artykuł został właśnie zaakceptowany.'
        );

        $user = new \stdClass();
        $user->email = 'k.dargiewicz@gmail.com';

        app(ContactController::class)->sendToAddress($dto, $user->email);


        $this->info("Wiadomość została wysłana na: {$user->email}");
        return true;
    }
}
