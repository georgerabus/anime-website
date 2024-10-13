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

        $comment->user_id = Auth::id(); // This sets the user_id field
        
        $comment->text = $request->comment;
        $comment->save();
        return redirect(route('animePage'));
    }
}
