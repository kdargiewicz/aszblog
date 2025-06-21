<?php

namespace App\Mail\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\DTO\ContactMessageDTO;
use App\Mail\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendToAddress(ContactMessageDTO $dto, string $recipientEmail): void
    {
        Mail::to($recipientEmail)->send(new ContactMessageMail($dto));
    }
}

