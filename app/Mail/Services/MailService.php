<?php

namespace App\Mail\Services;

use App\Cms\Models\Article;
use App\Cms\Models\Comments;
use App\Mail\BlogContactMail;
use App\Mail\ContactMessageMail;
use App\Mail\DTO\ContactMessageDTO;
use App\Mail\DTO\SendNotificationDTO;
use App\Mail\Models\ContactMessage;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendNewCommentNotification(Comments $comment): void
    {
        $articleData = app(Article::class)->getArticleOwnerInfo($comment->article_id);

        if ($articleData && $articleData->email) {
            $name = __('messages.mail.notification_comment_subject', [
                'id' => $comment->article_id,
                'title' => $articleData->title ?? __('article.article_list.no_title'),
            ]);

            $dto = new SendNotificationDTO(
                name: $name,
                email: $articleData->email,
                message: __('messages.mail.view_notification'),
                comment: $comment->content
            );

            $this->submitNotificationMail($dto);
        }
    }

    public function submitNotificationMail(SendNotificationDTO $dto): void
    {
        Mail::to($dto->email)->send(new NotificationMail($dto));
    }

    public function submitContactEmail(SendNotificationDTO $dto): void
    {
        Mail::to($dto->email)->send(new BlogContactMail($dto));
    }

    public function submit(ContactMessageDTO $dto): void
    {
        ContactMessage::create((array) $dto);

        Mail::to($dto->email)->send(new ContactMessageMail($dto));
    }
}
