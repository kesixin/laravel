<?php

namespace App\Admin\Controllers;

class TopicController extends Controller
{
    public function index()
    {
        $topics = \App\Topic::paginate(10);
        return view('admin.topic.index',compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');

    }

    public function store()
    {


    }


}