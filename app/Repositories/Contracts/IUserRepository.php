<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IUserRepository
 *
 * Defines methods for interacting with the User data source.
 * This interface extends IBaseRepository to reuse common CRUD operations for the User model.
 */
interface IUserRepository extends IBaseRepository
{
    /**
     * Get a paginated list of Users.
     *
     * @return LengthAwarePaginator Paginated list of Users.
     */
    public function show(): LengthAwarePaginator;

    /**
     * Get a single User by their email address.
     *
     * @param string $email The email address of the User.
     * @return User|null The User object or null if not found.
     */
    public function getByEmail(string $email): ?User;
}
