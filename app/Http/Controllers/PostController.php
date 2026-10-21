<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //一覧
    public function index()
    {
        $posts = \App\Models\Post::all();
        return view('posts.index', compact('posts'));
    }

    //新規作成
    public function create()
    {
        return view('posts.create');
    }

    //保存
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ]);
        return redirect('/posts');
    }

    //編集
    public function edit($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    //更新
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect('/posts');
    }

    //削除
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }
}