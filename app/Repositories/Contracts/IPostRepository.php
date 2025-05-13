<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IPostRepository extends IBaseRepository
{
    public function show(): LengthAwarePaginator;
    public function getByTitle(string $title) : ?LengthAwarePaginator;
    public function getByUserId(string $user_id) : ?LengthAwarePaginator;
    public function getByCategoryId(int $category_id) : ?LengthAwarePaginator;
    public function getCategoryWithPostCount(): ?Collection;
    public function incrementView(int $id);
    public function getPopularPosts(int|null $id);
}
