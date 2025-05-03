<?php
namespace App\Services\Impl;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Mappers\UserDataMapper;
use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IAuthService;
use App\Services\Contracts\IUserService;
use App\Session\UserSession;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements IUserService
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

    public function show(int $perPage): ?LengthAwarePaginator
    {
        if($this->userSession->isAdmin()){
            return $this->repository->show($perPage);
        }
        return null;
    }

    public function findById(string $id): ?User {
        return $this->repository->getById($id);
    }

    public function update(string $id, UserRequest $request): ?User {
        if(!$this->userSession->isUserUsing($id)){
            return null;
        }
        $data = $this->userDataMapper->mapForEdit($request);
        $data['user_id'] = $id;
        return $this->repository->update($data, $id);
    }

    public function delete(string $id, Request  $request): ?User {
        if(!$this->userSession->isUserUsing($id)){
            return null;
        }
        return $this->repository->delete($id);
    }
}
