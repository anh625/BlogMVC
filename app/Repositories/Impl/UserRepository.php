<?php
namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements IUserRepository
{
    private int $perPage;
    protected string $primaryKey = 'user_id';
    public function __construct()
    {
        $this->perPage = config('pagination.per_page');
        // Gọi constructor của BaseRepository và truyền vào model User
        parent::__construct(new User());
    }
    public function show(): LengthAwarePaginator
    {
        return User::paginate($this->perPage);
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

}
