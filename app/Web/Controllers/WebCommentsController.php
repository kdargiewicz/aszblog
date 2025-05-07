<?php

namespace App\Web\Controllers;

use App\Cms\Models\Comments;
use App\Http\Controllers\Controller;
use App\Mail\Services\MailService;
use App\Web\Requests\CommentsRequests;

class WebCommentsController extends Controller
{
    public function storeComment(CommentsRequests $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $comment = app(Comments::class)->store($data);

        if ($comment->id){
            //zapis do notification i wysylka email
            app(MailService::class)->sendNewCommentNotification($comment);
        }

        return redirect()->back()
            ->with('success', __('flash-messages.add_comment'));
    }
}
