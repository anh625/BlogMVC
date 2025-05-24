<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Contracts\IAdminService;
use App\Services\Contracts\ICategoryService;
use App\Services\Contracts\IPostService;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     private IPostService   $postService;
     private IAdminService $adminService;
     private ICategoryService $categoryService;
     public function __construct(IPostService $postService, IAdminService $adminService, ICategoryService $categoryService){
        $this->postService = $postService;
        $this->adminService = $adminService;
        $this->categoryService = $categoryService;
    }

    //
    public function dashboard()
    {
        $status = $this->getDashboardStats();
        return view('admin.dashboard.index', $status)->with('currentTitle', 'Trang quản trị');
    }

    public function posts()
    {
        $categories = $this->categoryService->getAll();
        $posts = $this->postService->showForAdmin();
        return view('admin.posts.index', compact('posts', 'categories'))->with('currentTitle', 'Danh sách bài viết');
    }

    public function detailpost($id)
    {
    $data = $this->postService->showById($id);
    $post = $data['post'];
    return view('admin.posts.detail', compact('post'))->with('currentTitle', 'Chi tiết bài viết');
    }

    public function getAllUsers()
    {
        $users = $this->adminService->listUsers(5);
        return view('admin.users.index', compact('users'))->with('currentTitle', 'Danh sách người dùng');
    }

    public function updateUserStatus(Request $request,string $UserId)
    {
        $request->validate([
            'user_status' => 'required|boolean',
        ]);

        $status = $request->input('user_status');
        $user = $this->adminService->updateStatusUser($UserId, $status);

        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'User status updated successfully.');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Failed to update user status.');
        }
    }

     public function getDashboardStats()
    {
        return [
            'active_users' => $this->adminService->countUsersByStatus(1),
            'inactive_users' => $this->adminService->countUsersByStatus(0),
            'active_posts' => $this->adminService->countPostsByStatus(1),
            'archived_posts' => $this->adminService->countPostsByStatus(0),
        ];
    }

    // đây là hàm xử lý rồi trả về kết quả. chưa trả về giao diện nào cả!!!
    public function searchPosts(Request $request){
         $posts = 'Not found';
         if($this->postService->searchPosts($request)){
             $posts = $this->postService->searchPosts($request);
         }
         dd($posts);
         return view('admin.posts.index', compact('posts'));
    }

    // đây là hàm xử lý rồi trả về kết quả. chưa trả về giao diện nào cả!!!
    public function searchUsers(Request $request){
         $users = 'Not found';
         if($this->adminService->searchUsers($request)){
             $users = $this->adminService->searchUsers($request);
         }
         dd($users);
        return view('admin.posts.index', compact('posts'));
    }
}
