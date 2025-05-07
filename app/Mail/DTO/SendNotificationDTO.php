<?php

namespace App\Mail\DTO;

class SendNotificationDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message,
        public string $comment,
    ) {}
}
