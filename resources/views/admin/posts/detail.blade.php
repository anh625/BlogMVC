@extends('admin.layouts.master')

@section('title', 'Chi tiết bài viết')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $post->title }}</h4>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Mã bài viết:</strong> {{ $post->post_id }}
            </div>

            <div class="mb-3">
                <strong>Tiêu đề:</strong> {{ $post->title }}
            </div>

            <div class="mb-3">
                <strong>Mô tả ngắn:</strong><br>
                {{ $post->description ?? 'Không có' }}
            </div>

            <div class="mb-3">
                <strong>Nội dung:</strong><br>
                <div>{!! $post->content !!}</div>
            </div>

            @if ($post->image)
                <div class="mb-3">
                    <strong>Ảnh thumbnail:</strong><br>
                    <img src="{{ asset('storage/'.$post->image) }}" alt="Ảnh thumbnail" class="img-thumbnail" style="max-width: 300px;">
                </div>
            @endif

            @if ($post->banner_image)
                <div class="mb-3">
                    <strong>Ảnh banner:</strong><br>
                    <img src="{{ asset('storage/'.$post->banner_image) }}" alt="Ảnh banner" class="img-fluid rounded shadow-sm">
                </div>
            @endif

            <div class="mb-3">
                <strong>Danh mục:</strong>
                {{ $post->category->category_name ?? 'Không rõ' }}
            </div>

            <div class="mb-3">
                <strong>Người tạo:</strong>
                @php
                //  dd($post->user);
                @endphp
                {{ $post->user->name ?? $post->user_id }}
            </div>

            <div class="mb-3">
                <strong>Lượt xem:</strong> {{ $post->view_counts }}
            </div>

            <div class="mb-3">
                <strong>Trạng thái:</strong>
                @if ($post->post_status)
                    <span class="badge bg-success">Công khai</span>
                @else
                    <span class="badge bg-secondary">Lưu trữ</span>
                @endif
            </div>

            <div class="mb-3">
                <strong>Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y H:i') }}
            </div>

            <div class="mb-3">
                <strong>Ngày cập nhật:</strong> {{ $post->updated_at->format('d/m/Y H:i') }}
            </div>

            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
        </div>
    </div>
</div>
@endsection
