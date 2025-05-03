@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Bài viết của tôi</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success">+ Thêm bài viết</a>
        </div>

        @if(count($posts) > 0)
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->description }}</p>
                                <small class="text-muted">Cập nhật: {{ $post->updated_at->format('d/m/Y') }}</small>

                                {{-- 💡 GỢI Ý: Hiển thị số lượt xem để người dùng biết bài nào đang hot --}}
                                <small class="text-muted mt-1">Lượt xem: {{ $post->view_counts }}</small>

                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('posts.edit', $post->post_id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                    <form action="{{ route('posts.destroy', $post->post_id) }}" method="POST" onsubmit="return confirm('Xoá bài viết này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xoá</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p>Bạn chưa có bài viết nào.</p>
        @endif
    </div>
@endsection
