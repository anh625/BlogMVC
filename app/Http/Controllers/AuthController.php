<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\Contracts\IAuthService;
use App\Session\UserSession;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function index(): View|Application|Factory
    {
        return view('welcome');
    }

    public function signin()
    {
        if(session()->has('user')){
            return redirect('/');
        }
        return view('auth.signin');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if($this->userService->login($request)){
            return redirect('/');
        };
        return back()
            ->withErrors(['error' => "Email hoặc Password không chính xác"])
            ->withInput();
    }

    public function signup()
    {
        if(session()->has('user')){
            return redirect()->route('/');
        }
        return view('auth.signup');
    }

    public function register(UserRequest $request)
    {
        $user = $this->userService->register($request);
        if($user){
            $this->userSession->flash('success','Đăng ký thành công');
            return redirect('/login');
        }
        return back()
            ->withErrors(['error' => 'Email đã tồn tại!'])
            ->withInput();
    }

    public function logout()
    {
        $this->userService->logout();
        return redirect('/sign-in');
    }

}
