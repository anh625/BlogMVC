<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\Contracts\IContactService;
use App\Session\UserSession;

class ContactController extends Controller
{
    private IContactService $contactService;
    private UserSession $userSession;
    public function __construct(IContactService $contactService
                                , UserSession $userSession){
        $this->contactService = $contactService;
        $this->userSession = $userSession;
    }
    //
    public function index(){
        return view('user.contact.form');
    }
    public function store(ContactRequest $request){
        if($this->contactService->add($request)){
            $this->userSession->flash('success','Send contact successfully!');
            return redirect()->route('posts.show');
        }
        return redirect()->back()
            ->withErrors([])
            ->withInput();
    }
}
