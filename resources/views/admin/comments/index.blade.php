{{-- @extends('layouts.admin') --}}

{{-- @section('content') --}}
<div class="container">

    <h2>Danh sách bình luận</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('comments.create') }}" class="btn btn-success mb-3">Thêm bình luận</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nội dung</th>
                <th>Người dùng</th>
                <th>Bài viết</th>
                <th>Ngày bình luận</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->cmt_content }}</td>
                    <td>{{ $comment->user_id }}</td>
                    <td>{{ $comment->post_id }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        {{-- <a href="{{ route('comments.edit', $comment->cmt_id) }}" class="btn btn-primary btn-sm">Sửa</a> --}}
                        {{-- <form action="{{ route('comments.destroy', $comment->cmt_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- @endsection --}}
