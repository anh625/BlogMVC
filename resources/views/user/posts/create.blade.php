{{-- resources/views/posts/create.blade.php--}}

@extends('user.layouts.app')
@section('content')

    <div class="container py-4">
        <!-- Nội dung form ở đây -->
        <div class="container">
            <h2>Thêm bài viết mới</h2>

            <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('user.posts.form', ['post' => null])
                <button type="submit" class="btn btn-success mt-2">Lưu</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary mt-2">Quay lại</a>
            </form>
        </div>
        @if ($errors->any())
            <div style="color: red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

