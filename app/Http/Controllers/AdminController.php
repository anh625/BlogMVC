<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Contracts\IPostService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     private IPostService   $postService;
     public function __construct(IPostService $postService){
        $this->postService = $postService;
    }

    //
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function posts()
    {
        $posts = $this->postService->showForAdmin();
        // dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    public function detailpost($id)
    {
    $data = $this->postService->showById($id);
    $post = $data['post'];
    return view('admin.posts.detail', compact('post'));
    }
}
