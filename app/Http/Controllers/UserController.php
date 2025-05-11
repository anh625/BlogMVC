<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\Contracts\IUserService;
use App\Session\UserSession;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private IUserService $userService;
    private UserSession $userSession;
    public function __construct(IUserService $userService, UserSession $userSession){
        $this->userService = $userService;
        $this->userSession = $userSession;
    }
    public function index(){
        if(!$this->userSession->getUser()){
            $this->userSession->flash('error','Bạn cần đăng nhập để xem trang cá nhân của mình!');
            return redirect()->route('posts.show');
        }
        $user_id = $this->userSession->getUser()['user_id'];
        $user = $this->userService->findById($user_id);
        $perPage = config('pagination.per_page');
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate($perPage);
        $data['posts'] = $posts;
        return view('user.dashboard', compact('user', 'data'));
    }

    public function edit(){
        if(!$this->userSession->getUser()){
            $this->userSession->flash('error','Bạn cần đăng nhập để sửa thông tin cá nhân');
            return redirect()->route('posts.show');
        }
        $user_id = $this->userSession->getUser()['user_id'];
        $user = $this->userService->findById($user_id);
        return view('user.edit')->with('user', $user);
    }

    public function update(UserRequest $request){
        $user_id = $this->userSession->getUser()['user_id'];
        if($this->userService->update($user_id, $request)){
            $user = $this->userService->findById($user_id);

            $this->userSession->setUser($user);
            return redirect()->route('user.index');
        }
        return back()
            ->withErrors(['error' => 'Permission denied'])
            ->withInput();
    }

}
