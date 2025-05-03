<?php

namespace App\Services\Impl;

use App\Repositories\Contracts\ICategoryRepository;
use App\Services\Contracts\ICategoryService;
use Illuminate\Support\Str;

class CategoryService implements ICategoryService
{
    protected $repository;

    public function __construct(ICategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        $data['category_slug'] = Str::slug($data['category_name']);
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $data['category_slug'] = Str::slug($data['category_name']);
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
