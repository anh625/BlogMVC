{{-- resources/views/posts/edit.blade.php --}}
@extends('layouts.app')


@section('content')
    <div class="container py-4">
        <h2>Sửa bài viết</h2>

        <form id="postForm" action="{{ route('posts.update', $post->post_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('posts.form', ['post' => $post])

            <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
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
@endsection

