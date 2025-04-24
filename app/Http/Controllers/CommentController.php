<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\ICommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private ICommentService $commentService;

    public function __construct(ICommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        // dd(session('user'));
        $comments = $this->commentService->getAll();
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.comments.create');
    }

    public function store(CommentRequest $request)
    {
        $this->commentService->create($request->validated());
        return redirect()->route('comments.index')->with('success', 'Tạo bình luận thành công!');
    }

    public function edit($id)
    {
        // $comment = $this->commentService->findById($id);
        // return view('admin.comments.edit', compact('comment'));
    }

    public function update(CommentRequest $request, $id)
    {
        $this->commentService->update($id, $request->validated());
        return redirect()->route('comments.index')->with('success', 'Cập nhật bình luận thành công!');
    }

    public function destroy($id)
    {
        $this->commentService->delete($id);
        return redirect()->route('comments.index')->with('success', 'Xóa bình luận thành công!');
    }
}

