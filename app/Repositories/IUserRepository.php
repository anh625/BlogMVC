<?php


namespace App\Repositories;

/**
 * Interface IUserRepository
 *
 * Defines methods for interacting with the User data source.
 */
interface IUserRepository
{
    /**
     * Get a paginated list of Users.
     *
     * @param int $perPage Number of Users per page
     * @return mixed Paginated list of Users
     */
    public function show(int $perPage);

    /**
     * Get a single User by its ID.
     *
     * @param string $id User user_id
     * @return mixed User object or null if not found
     */
    public function getById(string $id);

    /**
     * Get a single User by its ID.
     *
     * @param string $email User email
     * @return mixed User object or null if not found
     */
    public function getByEmail(string $email);

    /**
     * Store a new User in the database.
     *
     * @param array $data User data to be saved
     * @return mixed Created User
     */
    public function store(array $data);

    /**
     * Update an existing User.
     *
     * @param array $data Updated User data
     * @param string $id User user_id
     * @return mixed Updated User or null if not found
     */
    public function update(array $data, string $id);

    /**
     * Delete a User by its ID.
     *
     * @param string $id User user_id
     * @return mixed Deleted User or null if not found
     */
    public function delete(string $id);
}
