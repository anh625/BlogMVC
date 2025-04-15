<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Đã đăng bài thành công!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
