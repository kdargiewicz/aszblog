<?php

namespace App\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DTO\SendNotificationDTO;
use App\Mail\Services\MailService;
use App\Web\Models\Settings;
use App\Web\Requests\MailContactRequest;

class MailContactController extends Controller
{
    public function sendMailFromReader(MailContactRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        session()->forget('captcha_sum');

        $dto = new SendNotificationDTO(
            name: __('blog.contact.contact_subject', ['name' => $data['contact_name']]),
            email: app(Settings::class)->getRecipientEmail(),
            message: __('blog.contact.from_email', [
                'email' => $data['contact_email'] ?? __('blog.contact.no_email')
            ]),
            comment: $data['contact_message']
        );

        app(MailService::class)->submitContactEmail($dto);

        return redirect()->back()->with('success', __('flash-messages.email_send'));
    }
}
