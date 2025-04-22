<?php

namespace App\Mail\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(__('mail.password_reset.subject'))
            ->greeting(__('mail.password_reset.greeting'))
            ->line(__('mail.password_reset.line_1'))
            ->action(__('mail.password_reset.action'), $url)
            ->line(__('mail.password_reset.line_2'))
            ->line(__('mail.password_reset.line_3'))
            ->salutation(__('mail.password_reset.salutation'));

    }
}

