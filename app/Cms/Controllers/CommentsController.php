<?php

namespace App\Cms\Controllers;

use App\Cms\Models\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getComments(): object
    {
        $comments = app(Comments::class)->getAllForUser(auth()->id());

        return view('cms.comments.list', compact('comments'));
    }

    public function toggleAccept(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $accept = (bool) $request->get('accept', false);
        Comments::where('id', $id)->update(['accepted' => $accept, 'update_date' => now()]);

        if ($accept) {
            return redirect()->back()->with('success', __('comments.accepted_comments'));
        }

        return redirect()->back()->with('error', __('comments.withdrawal_acceptance'));
    }

}
