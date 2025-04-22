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
    public function showForm()
    {
        return view('contact.form');
    }

    public function sendToAddress(ContactMessageDTO $dto, string $recipientEmail): void
    {
        Mail::to($recipientEmail)->send(new ContactMessageMail($dto));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:5000',
        ]);

        $dto = new ContactMessageDTO(
            name: $validated['name'],
            email: $validated['email'],
            message: $validated['message']
        );

        ContactMessage::create((array)$dto);

        Mail::to('admin@aszblog.pl')->send(new ContactMessageMail($dto));

        return redirect()->back()->with('success', 'Dziękujemy za wiadomość!');
    }
}

Mail::raw('Test mail from Laravel', function ($msg) {
    $msg->to('k.dargiewicz@gmail.com')->subject('Test');
});

