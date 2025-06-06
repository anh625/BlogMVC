{{-- resources/views/posts/edit.blade.php --}}
@extends('user.layouts.app')


@section('content')
    <div class="container py-4">
        <h2>Edit post</h2>

        <form id="postForm" action="{{ route('posts.update', $post->post_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('user.posts.form', ['post' => $post])

            <button type="submit" class="btn btn-primary mt-2">EDIT</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-2">QUIT</a>
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

