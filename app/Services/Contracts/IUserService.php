<?php
namespace App\Services\Contracts;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/**
 * Interface IUserService
 *
 * Defines the contract for authentication services, including user management and session handling.
 */
interface IUserService
{
    /**
     * Get a paginated list of Users.
     *
     * @param int $perPage The number of users per page.
     * @return LengthAwarePaginator|null A paginated list of users or null if not authorized.
     */
    public function show(int $perPage): ?LengthAwarePaginator;

    /**
     * Find a User by their ID.
     *
     * @param string $id The ID of the user.
     * @return User|null The user object or null if not found.
     */
    public function findById(string $id): ?User;
    /**
     * Update an existing user.
     *
     * @param string $id The ID of the user to be updated.
     * @param UserRequest $request The request containing the updated user data.
     * @return User|null The updated user or null if the user is not authorized to update.
     */
    public function update(string $id, UserRequest $request): ?User;

    /**
     * Delete a user.
     *
     * @param string $id The ID of the user to be deleted.
     * @param Request $request The request object.
     * @return User|null The deleted user or null if the user is not authorized to delete.
     */
    public function delete(string $id, Request $request): ?User;

    /**
     * Log out the current user and clear the session.
     *
     * @return void
     */
}
