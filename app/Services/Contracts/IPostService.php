<?php

namespace App\Services\Contracts;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface IPostService
 *
 * Defines the contract for authentication services, including user management and session handling.
 */
interface IPostService
{
    public function show() : LengthAwarePaginator;
    public function showById(int $id) : ?array;
    public function searchByTitle(string $title) : ?array;

    public function searchByUserId(string $user_id) : ?array;
    public function searchByCategoryId(int $category_id) : ?array;
    public function add(PostRequest $request) : ?Post;
    public function edit(int $post_id, PostRequest $request ) : ?Post;
    public function destroy(int $post_id) : ?Post;
    public function getAllCategories() : ?Collection ;
    public function getPopularPosts(int|null $id) ;
    public function getById(int $id);
}
