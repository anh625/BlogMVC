<?php

namespace App\Repositories\Impl;

use App\Models\Category;
use App\Repositories\Contracts\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        $exists = $this->model->where('category_name', $data['category_name'])->exists();
        if ($exists) {
            return null;
        }

        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->findById($id);
        $exists = $this->model->where('category_name', $data['category_name'])->exists();
        if ($exists) {
            return null; 
        }
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        return $category->delete();
    }

    public function getPostsForCategory($categoryId)
    {
        return $this->model->findOrFail($categoryId)->posts;
    }
}
