<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\Impl\AuthService;

class AuthController extends Controller
{
    private AuthService $userService;
    //
    public function __construct(AuthService $userService){
        $this->userService = $userService;
    }

    public function index()
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

    public function login(LoginRequest $request){
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
            return redirect('/');
        }
        return view('auth.signup');
    }

    public function register(UserRequest $request){
        $user = $this->userService->register($request);
        if($user){
            session(['user' => $user]);
            return redirect('/');
        }
        return back()
            ->withErrors(['error' => 'Email đã tồn tại!'])
            ->withInput();
    }

    public function logout(){
        $this->userService->logout();
        return redirect('/sign-in');
    }

}
