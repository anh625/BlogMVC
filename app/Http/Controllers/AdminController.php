<?php

namespace App\Http\Controllers;

use App\Services\Contracts\IAdminService;
use App\Services\Contracts\IContactService;
use App\Services\Contracts\IPostService;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     private IPostService $postService;
     private IAdminService $adminService;
     private IContactService $contactService;
     public function __construct(IPostService $postService,
                                 IAdminService $adminService,
                                 IContactService $contactService){
        $this->postService = $postService;
        $this->adminService = $adminService;
        $this->contactService = $contactService;
    }

    //
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function posts()
    {
        $posts = $this->postService->show();
        dd($posts);
        return view('admin.posts.index', compact('posts'));
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

    public function showContactById(int $id)
    {
        $contact = $this->contactService->showById($id);
        dd($contact);
    }

    public function showContact()
    {
        $contacts = $this->contactService->show();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function updateContact(int $id, Request $request)
    {
        $this->contactService->update($request, $id);
        return redirect()->route('admin.contacts.index');
    }

    public function deleteContact(int $id)
    {
        $this->contactService->destroy($id);
        return redirect()->route('admin.contacts.index');
    }
}
