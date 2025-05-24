@extends('admin.layouts.master')

@section('title', 'Chi tiết bài viết')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 fw-bold">Tiêu đề: {{ $post->title }}</h4>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <h6 class="fw-semibold">Mô tả ngắn</h6>
                <p class="mb-0">{{ $post->description ?? 'Không có' }}</p>
            </div>

            <div class="mb-4">
                <h6 class="fw-semibold">Nội dung</h6>
                <div class="border rounded p-3 bg-light" style="white-space: pre-wrap;">{!! $post->content !!}</div>
            </div>

            @if ($post->image)
                <div class="mb-4">
                    <h6 class="fw-semibold">Ảnh thumbnail</h6>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Ảnh thumbnail" class="img-thumbnail" style="max-width: 320px;">
                </div>
            @endif

            @if ($post->banner_image)
                <div class="mb-4">
                    <h6 class="fw-semibold">Ảnh banner</h6>
                    <img src="{{ asset('storage/' . $post->banner_image) }}" alt="Ảnh banner" class="img-fluid rounded shadow-sm">
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Danh mục:</strong>
                    <p>{{ $post->category->category_name ?? 'Không rõ' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Người tạo:</strong>
                    <p>{{ $post->user->name ?? $post->user_id }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Lượt xem:</strong>
                    <p>{{ $post->view_counts }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Trạng thái:</strong><br>
                    @if ($post->post_status)
                        <span class="badge bg-success">Công khai</span>
                    @else
                        <span class="badge bg-secondary">Lưu trữ</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <strong>Ngày tạo:</strong><br>
                    <p>{{ $post->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Ngày cập nhật:</strong><br>
                    <p>{{ $post->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
