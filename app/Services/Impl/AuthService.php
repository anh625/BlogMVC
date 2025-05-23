<?php
namespace App\Services\Impl;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Mappers\UserDataMapper;
use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IAuthService;
use App\Session\UserSession;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthService implements IAuthService
{
    private IUserRepository $repository;
    private UserDataMapper $userDataMapper;
    private UserSession $userSession;

    public function __construct(IUserRepository $repository,
                                UserDataMapper  $userDataMapper,
                                UserSession     $userSession)
    {
        $this->repository = $repository;
        $this->userDataMapper = $userDataMapper;
        $this->userSession = $userSession;
    }
    public function register(UserRequest $request): ?User {
        $user = $this->repository->getByEmail($request->get('email'));
        if($user) {
            return null;
        }
        $data = $this->userDataMapper->mapForCreate($request);
        return $this->repository->store($data);
    }

    public function login(LoginRequest $request): ?array
    {
        $user = $this->repository->getByEmail($request->get('email'));
        $data['status'] = 'success';
        if($user && $user->is_active == false) {
            $data['status'] = 'error';
            $data['message'] = 'Your account has been deactivated.';
            return $data;
        }
        if(!$user || $user->password != $request->get('password')) {
            $data['status'] = 'error';
            $data['message'] = 'Email or password is incorrect.';
            return $data;
        }
        $this->userSession->setUser($user);
        return $data;
    }

    public function logout(): void
    {
        $this->userSession->flush();
    }
}
