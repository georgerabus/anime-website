<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController
{
    public function store(Request $request){
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();  
        $comment->text = $request->comment;
        $comment->save();
        return redirect(route('animePage'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $reply = new Comment();
        $reply->text = $request->reply;
        $reply->user_id = Auth::id();
        $reply->parent_id = $id; 
        $reply->save();

        // Redirect back or return a response (you may want to handle it as an AJAX response)
        return redirect()->back()->with('success', 'Reply submitted successfully!');
    }


}
