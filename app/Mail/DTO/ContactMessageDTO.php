<?php

namespace App\Mail\DTO;

class ContactMessageDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message
    ) {}
}

