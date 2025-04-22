<?php

namespace App\Mail\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(__('mail.email_verification.subject'))
            ->greeting(__('mail.email_verification.greeting'))
            ->line(__('mail.email_verification.line_1'))
            ->action(__('mail.email_verification.action'), $verificationUrl)
            ->line(__('mail.email_verification.line_2'))
            ->salutation(__('mail.email_verification.salutation'));
    }

    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}

