<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{

    /**
     * create post page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function create() :Response
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created post in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request) :RedirectResponse
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->back()->with('success' , 'Post saved successfully');
    }

    /**
     * edit post page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function edit(Post $post) :Response
    {
        return Inertia::render('Post/Create', ['post' => $post]);
    }

    /**
     * update post in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post) :RedirectResponse
    {
        if(Auth::user()->id != $post->user_id) {
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = Auth::user()->id;
            $post->save();
        }
        else{
            abort(409);
        }

        return redirect()->back()->with('success' , 'Post updated successfully');
    }

    /**
     * show post page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function show(Post $post) :Response
    {
        if(Auth::user()) {
            $userType = 'admin';
        }
        else {
            $userType = 'guest';
        };

        $post->load('comments');

        return Inertia::render('Post/Show', ['post' => $post, 'userType' => $userType]);
    }

    /**
     * Store a delete post from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Post $post) :RedirectResponse
    {
        if(Auth::user()->id == $post->user_id) {
            $post->delete();
        }
        else {
            abort(403);
        };

        return redirect()->back()->with('success' , 'Post deleted successfully');
    }

}
