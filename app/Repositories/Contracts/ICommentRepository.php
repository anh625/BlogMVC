<?php

namespace App\Repositories\Contracts;

interface ICommentRepository
{
    //
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getCommentsByPostId($postId);

}
