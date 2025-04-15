<?php
namespace App\Repositories\Contracts;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface IBaseRepository
 *
 * Defines methods for interacting with the data source.
 *
 * @template TModel of Model
 */
interface IBaseRepository
{
    /**
     * Get a single record by its ID.
     *
     * @param int|string $id The ID of the record
     * @return TModel|null The record or null if not found
     */
    public function getById(int|string $id);

    /**
     * Store a new record in the database.
     *
     * @param array $data Data to store
     * @return TModel The created record
     */
    public function store(array $data);

    /**
     * Update an existing record.
     *
     * @param array $data The updated data
     * @param int|string $id The ID of the record
     * @return TModel|null The updated record or null if not found
     */
    public function update(array $data, int|string $id);

    /**
     * Delete a record by its ID.
     *
     * @param int|string $id The ID of the record
     * @return TModel|null The deleted record or null if not found
     */
    public function delete(int|string $id);
}
