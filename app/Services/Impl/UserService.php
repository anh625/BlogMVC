<?php
namespace App\Services\Impl;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\IUserRepository;
use App\Services\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository) {
        $this->repository = $repository;
    }

    public function show(int $perPage): ?User{
        if(session()->has('user') && session('user')->isAdmin()){
            return $this->repository->show($perPage);
        }
        return null;
    }

    public function findById(string $id): ?User {
        return $this->repository->getById($id);
    }

    public function register(UserRequest $request): ?User {
        $user = $this->repository->getByEmail($request->get('email'));
        if($user) {
            return null;
        }
        $data = $this->getUser($request);
        return $this->repository->store($data);
    }

    public function login(LoginRequest $request): ?User
    {
        $user = $this->repository->getByEmail($request->get('email'));

        if($user && $user->password == $request->get('password')) {
            session([ 'user' => $user]);
            return $user;
        }
        return null;
    }

    public function update(string $id, UserRequest $request): ?User {
        if(!$this->hasUser($id)){
            return null;
        }
        $data = $this->getUser($request);
        return $this->repository->update($data, $id);
    }

    public function delete(string $id, Request  $request): ?User {
        if(!$this->hasUser($id)){
            return null;
        }
        return $this->repository->delete($id);
    }

    private function hasUser(string $user_id): bool
    {
        if (session()->get('user') == $user_id) {
            return true;
        };
        return false;
    }

    private function getUser(UserRequest $request): array
    {
        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
        ];
        $data['user_id'] = Str::uuid();
        $data['is_admin'] = false;
        return $data;
    }

    public function logout(){
        session()->flush();
    }
}
