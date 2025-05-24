<?php

namespace App\Services\Impl;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IAdminService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AdminService implements IAdminService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get a list of all users with pagination.
     *
     * @param int $perPage Number of users per page.
     * @return LengthAwarePaginator Paginated list of users.
     */
    public function listUsers(int $perPage): LengthAwarePaginator
    {
        return $this->repository->show($perPage);
    }

    /**
     * Get a user by their ID.
     *
     * @param string $userId The user's ID.
     * @return User|null The user object or null if not found.
     */
    public function getUserById(string $userId): ?User
    {
        return $this->repository->getById($userId);
    }

    /**
     * Create a new user (admin only).
     *
     * @param array $data The data for the new user (e.g. email, password, etc.).
     * @return User|null The newly created user or null if creation failed.
     */
    public function createUser(array $data): ?User
    {
        // Ensure password is hashed before saving
        $data['user_password'] = Hash::make($data['user_password']);

        // Check if the user already exists
        $existingUser = $this->repository->getByEmail($data['user_email']);
        if ($existingUser) {
            return null;  // User already exists
        }

        return $this->repository->store($data);
    }

    /**
     * Delete a user by their ID.
     *
     * @param string $userId The user's ID.
     * @return User|null The deleted user or null if the user is not found.
     */
    public function updateStatusUser(string $userId, bool $status): ?User
    {
        // Find the user by ID
        $user = $this->repository->getById($userId);
        if (!$user) {
            return null;
        }
        return $this->repository->update(['is_active'=>$status], $userId);
    }

    /**
     * Update user role (admin only).
     *
     * @param string $userId The user's ID.
     * @param string $role The new role to assign to the user.
     * @return User|null The updated user or null if the user is not found.
     */
    public function updateUserRole(string $userId, string $role): ?User
    {
        // Ensure only valid roles are allowed
        $validRoles = ['admin', 'user'];
        if (!in_array($role, $validRoles)) {
            return null;  // Invalid role
        }

        // Find the user by ID
        $user = $this->repository->getById($userId);
        if (!$user) {
            return null;
        }

        // Update role
        $user->role = $role;
        $user->save();
        return $user;
    }

     public function countUsersByStatus(int $isActive): int
    {
        return User::where('is_active', $isActive)->count();
    }

    public function countPostsByStatus(int $status): int
    {
        return Post::where('post_status', $status)->count();

    }
    public function searchUsers(Request $request, int $perPage = 10): LengthAwarePaginator
    {
        $data=[];
        if($request->input('name') != ''){
            $data['name'] = $request->input('name');
        }
        if($request->input('email') != ''){
            $data['email'] = $request->input('email');
        }
        if($request->input('is_active') != ''){
            $data['is_active'] = $request->input('is_active');
        }
        return $this->repository->search($data);
    }
}
