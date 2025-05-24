<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface IContactRepository extends IBaseRepository
{
    public function show(int $perPage = 10): LengthAwarePaginator;
}
