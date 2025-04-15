<?php
namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct()
    {
        // Gọi constructor của BaseRepository và truyền vào model User
        parent::__construct(new User());
    }
    public function show(int $perPage): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

}
