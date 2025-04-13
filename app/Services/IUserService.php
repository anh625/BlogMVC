<?php
namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Interface IUserService
 *
 * Defines the contract for managing Users, including
 * retrieving, creating, updating, and deleting Users.
 */
interface IUserService
{
    /**
     * Get a paginated list of Users.
     *
     * @param int $perPage Number of items per page
     * @return User|null Paginated list of Users
     */
    public function show(int $perPage): ?User;

    /**
     * Find a User by its ID.
     *
     * @param string $id User service_id
     * @return User|null User object or null if not found
     */
    public function findById(string $id): ?User;

    /**
     * Create and store a new User.
     *
     * @param UserRequest $request The validated request data
     * @return User|null The created User
     */
    public function register(UserRequest $request): ?User;

    /**
     * Update a User by its ID.
     *
     * @param string $id User service_id
     * @param UserRequest $request The validated request data
     * @return User|null The updated User or null if not found
     */
    public function update(string $id, UserRequest $request): ?User;

    /**
     * Delete a User by its ID.
     *
     * @param string $id User service_id
     * @return User|null The deleted User or null if not found
     */
    public function delete(string $id, Request  $request): ?User;
}
