<?php
namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
        return User::where('is_admin' , 'user')->paginate($this->perPage);
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function search(array $filters = [],int $perPage = 10): LengthAwarePaginator
    {
        return User::with('posts') // quan hệ user phải được khai báo trong model Post
        ->where('is_admin' , 'user')
        ->when(!empty($filters['key_word']), function ($q) use ($filters) {
                $keyword = $filters['key_word'];
                $q->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
            })
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->paginate($perPage);
    }

}
