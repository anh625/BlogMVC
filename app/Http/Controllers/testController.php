<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class testController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'], // Đây là HTML từ TinyMCE
        ]);

        return redirect()->back()->with('success', 'Đã đăng bài viết!');
    }
}
