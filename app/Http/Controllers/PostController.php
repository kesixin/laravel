<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //
    public function index()
    {

        $posts=Post::orderby('created_at','desc')->paginate(6);

        return view('post.index',compact('posts'));
    }

    public function create()
    {

        return view('post.create');
    }

    public function store()
    {

        return view('post.store');
    }

    public function show(Post $post)
    {
        return view('post.show',compact('post'));

    }

    public function edit()
    {
        return view('post.edit');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
