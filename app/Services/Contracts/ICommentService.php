<?php

namespace App\Services\Contracts;

interface ICommentService
{
    //
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getCommentsByPostId($post_id);

}
