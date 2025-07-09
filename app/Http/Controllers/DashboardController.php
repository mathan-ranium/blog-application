<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    /**
     * dashboard page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function dashboard() :Response
    {
        $posts = Post::get();

        return Inertia::render('Dashboard',[
            'posts' => $posts
        ]);
    }
}
