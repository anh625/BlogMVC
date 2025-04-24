{{-- @extends('layouts.admin')

@section('content') --}}
<div class="container">
    <h2>Thêm bình luận</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="cmt_content">Nội dung</label>
            <textarea name="cmt_content" class="form-control" required>{{ old('cmt_content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="user_id">ID người dùng</label>
            <input type="text" name="user_id" class="form-control" value="{{ old('user_id') }}" required>
        </div>
        <div class="form-group">
            <label for="post_id">ID bài viết</label>
            <input type="text" name="post_id" class="form-control" value="{{ old('post_id') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
{{-- @endsection --}}
