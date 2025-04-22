<?php

namespace App\Mail;

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\DTO\ContactMessageDTO;

class ContactMessageMail extends Mailable
{
    use SerializesModels;

    public ContactMessageDTO $dto;

    public function __construct(ContactMessageDTO $dto)
    {
        $this->dto = $dto;
    }

    public function build(): static
    {
        return $this->subject(__('messages.mail.system_subject_mail'))
            ->view('mail.contact-mail')
            ->with(['dto' => $this->dto]);
    }
}
