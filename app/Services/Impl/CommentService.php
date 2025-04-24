<?php

namespace App\Services\Impl;

use App\Repositories\ICommentRepository;
use App\Services\ICommentService;
use Illuminate\Support\Facades\Auth;

class CommentService implements ICommentService
{
    protected $repository;

    public function __construct(ICommentRepository $repository)
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
        // $user = session('user');
        // $data['user_id'] = $user->user_id;
        // dd($data);
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
