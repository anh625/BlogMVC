<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
     * @return LengthAwarePaginator Paginated list of Posts.
     */
    public function show(): LengthAwarePaginator;

    /**
     * @param string $title
     * @return Post|null
     */
    public function getByTitle(string $title) : ?LengthAwarePaginator;

    /**
     * @param string $user_id
     * @return Post|null
     */
    public function getByUserId(string $user_id) : ?LengthAwarePaginator;

    /**
     * @param int $category_id
     * @return Post|null
     */
    public function getByCategoryId(int $category_id) : ?LengthAwarePaginator;

    /**
     * @return Collection|null
     */
    public function getCategoryWithPostCount(): ?Collection;
}
