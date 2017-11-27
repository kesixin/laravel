<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Zan;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {

        $posts = Post::orderby('created_at', 'desc')->withCount(['zans','comments'])->with('user')->paginate(6);

        //load 预加载
        //$posts->load('user');

        return view('post.index', compact('posts'));
    }

    public function create()
    {

        return view('post.create');
    }

    public function store()
    {

        //验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $user_id = Auth::id();
        $params = array_merge(request(['content', 'title']), compact('user_id'));

        $post = Post::create($params);
        return redirect('/posts');

    }

    public function show(Post $post)
    {
        //预加载评论
        $post->load('comments');
        return view('post.show', compact('post'));

    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);
        //权限验证
        $this->authorize('update', $post);

        //保存
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }

    public function delete(Post $post)
    {
        //权限验证
        $this->authorize('delete', $post);
        $post->delete();

        return redirect('/posts');
    }

    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    //评论
    public function comment(Post $post)
    {
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);

        $comment = new Comment();
        $comment->user_id= Auth::id();
        $comment->content= request('content');

        $post->comments()->save($comment);

        return back();

    }

    //赞文章
    public function zan(Post $post)
    {
        $param = [
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ];
        //查找或者创建
        Zan::firstOrCreate($param);
        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }

    //文章搜索
    public function search()
    {
        //验证
        $this->validate(request(),[
            'query'=>'required',
        ]);

        //逻辑
        $query=\request('query');
        $posts=Post::search($query)->paginate(2);

        $posts->load('user');

        //渲染

        return view('post.search',compact('posts','query'));
    }

}
