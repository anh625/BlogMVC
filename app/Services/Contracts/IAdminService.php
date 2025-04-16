<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IAdminService
 *
 * Defines methods for admin-related user management.
 */
interface IAdminService
{
    /**
     * Get a paginated list of all users.
     *
     * @param int $perPage The number of users per page.
     * @return LengthAwarePaginator Paginated list of users.
     */
    public function listUsers(int $perPage): LengthAwarePaginator;

    /**
     * Get a user by their ID.
     *
     * @param string $userId The user's ID.
     * @return User|null The user object or null if not found.
     */
    public function getUserById(string $userId): ?User;

    /**
     * Create a new user (admin only).
     *
     * @param array $data The data for the new user (e.g., email, password, etc.).
     * @return User|null The newly created user or null if creation failed (e.g., user already exists).
     */
    public function createUser(array $data): ?User;

    /**
     * Update an existing user's details.
     *
     * @param string $userId The user's ID.
     * @param array $data The data to update (e.g., password, name, phone, etc.).
     * @return User|null The updated user or null if the user is not found.
     */
    public function updateUser(string $userId, array $data): ?User;

    /**
     * Delete a user by their ID.
     *
     * @param string $userId The user's ID.
     * @return User|null The deleted user or null if the user is not found.
     */
    public function deleteUser(string $userId): ?User;

    /**
     * Update the role of a user (admin only).
     *
     * @param string $userId The user's ID.
     * @param string $role The new role to assign to the user (e.g., 'admin', 'user', 'editor').
     * @return User|null The updated user or null if the user is not found or if the role is invalid.
     */
    public function updateUserRole(string $userId, string $role): ?User;
}
