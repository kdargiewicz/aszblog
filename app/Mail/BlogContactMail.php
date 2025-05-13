<?php

namespace App\Mail;

use App\Mail\DTO\SendNotificationDTO;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogContactMail extends Mailable
{
    use SerializesModels;

    public SendNotificationDTO $dto;

    public function __construct(SendNotificationDTO $dto)
    {
        $this->dto = $dto;
    }

    public function build(): static
    {
        return $this->subject(__('messages.mail.notification_mail'))
            ->view('mail.blog-contact-mail')
            ->with(['dto' => $this->dto]);
    }
}
