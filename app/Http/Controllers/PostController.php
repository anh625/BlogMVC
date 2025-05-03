<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\Services\Contracts\IPostService;
use App\Session\UserSession;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PostController extends Controller
{
    private IPostService $postService;
    private UserSession $userSession;
    public function __construct(IPostService $postService, UserSession $userSession){
        $this->postService = $postService;
        $this->userSession = $userSession;
    }

    public function index(){
        return redirect()->route('posts.show');
    }
    //
    private function renderPostsView($data)
    {
        if ($data['posts']->isEmpty()) {
            $data['posts'] = 'No posts found';
        }
        if (array_key_exists('category_name', $data) && !$data['category_name']) {
            $data['category_name'] = 'No results found';
        }
        if (array_key_exists('user_name', $data) && !$data['user_name']) {
            $data['user_name'] = 'No found';
        }
        if (array_key_exists('title', $data)) {
            $data['title'] = "'".$data['title']."'";
        }
        $data['categories'] = $this->postService->getAllCategories();
        $data['popularPosts'] = $this->postService->getPopularPosts(null);
        return view('posts.show', compact('data'));
    }

    public function show()
    {
        $data['posts'] = $this->postService->show();
        return $this->renderPostsView($data);
    }
    public function showById(int $post_id)
    {
        $data = $this->postService->showById($post_id);
        if ($data['post'] == null) {
            $this->userSession->flash('error', 'Post not found');
            return redirect()->route('posts.show');
        }
        $data['categories'] = $this->postService->getAllCategories();
        $data['popularPosts'] = $this->postService->getPopularPosts($post_id);
        return view('posts.showById', compact('data'));
    }

    public function showByUserId(string $user_id)
    {
        $data = $this->postService->searchByUserId($user_id);
        return $this->renderPostsView($data);
    }

    public function showByTitle(Request $request)
    {
        $title = $request->input('title') . "";
        $data = $this->postService->searchByTitle($title);
        $data['title'] = $title;
        return $this->renderPostsView($data);
    }

    public function showByCategoryId(int $category_id)
    {
        $data = $this->postService->searchByCategoryId($category_id);
        return $this->renderPostsView($data);
    }

    public function showFormCreatePost()
    {
        $categories = $this->postService->getAllCategories();
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        if($this->postService->add($request)){
            return redirect('/posts');
        }
        return redirect()->back()
            ->withErrors([])
            ->withInput();
    }

    public function showFormEditPost(int $post_id)
    {
        $categories = $this->postService->getAllCategories();
        $post = $this->postService->getById($post_id);
        $user_id = $post->user_id;
        if(!$this->userSession->isUserUsing($user_id)){
            $this->userSession->flash('error', "You don't have permission to edit this post");
            return redirect()->route('posts.show');
        };
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, int $post_id)
    {
        if($this->postService->edit($post_id, $request)){
            return redirect('/posts');
        }
        return back()
            ->withErrors(['error' => 'Permission denied'])
            ->withInput();
    }

    public function destroy(int $post_id){
        if($this->postService->destroy($post_id)){
            return redirect('/posts');
        }
        return back()
            ->withErrors(['error' => 'Permission denied']);
    }
}
