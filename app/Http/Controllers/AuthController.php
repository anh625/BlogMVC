<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\Contracts\IAuthService;
use App\Session\UserSession;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    private IAuthService $userService;
    private UserSession $userSession;
    //
    public function __construct(IAuthService $userService, UserSession $userSession){
        $this->userService = $userService;
        $this->userSession = $userSession;
    }

    public function index()
    {
        if($this->userSession->isAdmin()) return redirect()->route('admin.dashboard.index');
        return redirect()->route('posts.show');
    }

    public function signin()
    {
//        if(session()->has('user')){
//            return redirect('/');
//        }
        return view('auth.signin');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $this->userService->login($request);
        if($data['status'] === 'success'){
            return redirect()->route('auth.index');
        }
        return back()
            ->withErrors(['error' => $data['message']])
            ->withInput();
    }

    public function signup()
    {
//        if(session()->has('user')){
//            return redirect()->route('/');
//        }
        return view('auth.signup');
    }

    public function register(UserRequest $request)
    {
        $user = $this->userService->register($request);
        if($user){
            $this->userSession->flash('success','Registered successfully');
            return redirect()->route('sign-in');
        }
        return back()
            ->withErrors(['error' => 'Email existed!'])
            ->withInput();
    }

    public function logout()
    {
        $this->userService->logout();
        return redirect('/sign-in');
    }

}
