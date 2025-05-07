<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.mail.notification_mail') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 2rem;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 720px; margin: auto; background-color: #ffffff; padding: 2rem; border-radius: 8px;">
    <tr>
        <td style="text-align: center;">
            <h2 style="color: #2c3e50; font-size: 20px; line-height: 1.4; word-break: break-word; margin-bottom: 1rem;">
                {{ $dto->name }}
            </h2>
        </td>
    </tr>
    <tr>
        <td>
            <p style="font-size: 16px; color: #333333;">
                {{ $dto->message }}
            </p>

            @if(!empty($dto->comment))
                <blockquote style="border-left: 4px solid #3498db; padding-left: 1rem; margin: 1rem 0; color: #555;">
                    {{ $dto->comment }}
                </blockquote>
            @endif

            <p style="font-size: 16px;">
                <a href="{{ url('/comments') }}" style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                    {{ __('mail.notification.see_comment') }}
                </a>
            </p>

            <p style="margin-top: 2rem; font-size: 14px; color: #999;">
                {{ __('mail.notification.message_generated_automatically') }}
            </p>
        </td>
    </tr>
</table>
</body>
</html>

