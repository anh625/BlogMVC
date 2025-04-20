<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IPostRepository
 *
 * Defines methods for interacting with the Post data source.
 * This interface extends IBaseRepository to reuse common CRUD operations for the Post model.
 */
interface IPostRepository extends IBaseRepository
{
    /**
     * Get a paginated list of Posts.
     *
     * @param int $perPage The number of Posts to display per page.
     * @return LengthAwarePaginator Paginated list of Posts.
     */
    public function show(int $perPage): LengthAwarePaginator;

    /**
     * Get a single Post by their email address.
     *
     * @param string $email The email address of the Post.
     * @return Post|null The Post object or null if not found.
     */
    public function getByEmail(string $email): ?Post;
}
