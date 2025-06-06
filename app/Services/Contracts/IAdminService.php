<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IAdminService
 *
 * Defines methods for admin-related user management.
 */
interface IAdminService
{
    public function listUsers(int $perPage): LengthAwarePaginator;
    public function getUserById(string $userId): ?User;
    public function createUser(array $data): ?User;
    public function updateStatusUser(string $userId, bool $status): ?User;
    public function updateUserRole(string $userId, string $role): ?User;
    public function countUsersByStatus(int $isActive): int;
    public function countPostsByStatus(int $status): int;
    public function searchUsers(Request $request, int $perPage = 10): LengthAwarePaginator;
}
