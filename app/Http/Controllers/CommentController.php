<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request):RedirectResponse
    {
        $comment = new Comment();
        $comment->username = $request->username;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->save();
        
        return redirect()->back()->with('success' , 'Comment updated successfully');
    }
}
