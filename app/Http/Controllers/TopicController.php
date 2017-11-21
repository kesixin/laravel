<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use App\PostTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //专题详情页
    public function show(Topic $topic)
    {
        //带文章数的专题
        $topic = \App\Topic::withCount('postTopics')->find($topic->id);
        //专题的文章列表
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
        //属于我的文章，但未投稿
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show',compact(['topic','posts','myposts']));
    }

    //专题投稿
    public function submit(Topic $topic)
    {
        $this->validate(request(),[
           'post_ids'=>'required|array',
        ]);

        $post_ids= \request('post_ids');
        $topic_id=$topic->id;

        foreach ($post_ids as $post_id)
        {
            \App\PostTopic::firstOrCreate(compact('post_id','topic_id'));
       }

       return back();
    }
}
