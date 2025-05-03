<?php

namespace App\Repositories\Impl;
use App\Models\Comment;
use App\Repositories\Contracts\ICommentRepository;

class CommentRepository implements ICommentRepository
{
    public function getAll()
    {
        return Comment::with(['user', 'post'])->get();
    }

    public function findById($id)
    {
        return Comment::findOrFail($id);
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($id, array $data)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function delete($id)
    {
        return Comment::destroy($id);
    }
    public function getCommentsByPostId($post_id)
{
    return Comment::where('post_id', $post_id)->get();
}

}
