<?php

namespace Easel\Http\Controllers\Backend;

use Easel\Models\Tag;
use Easel\Models\Post;
use Easel\Models\User;
use Easel\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display search result.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $params = request('search');

        $posts = Post::search($params)->get();
        $tags = Tag::search($params)->get();
        $users = User::search($params)->get();

        return view('canvas::backend.search.index', compact('posts', 'tags', 'users'));
    }
}
