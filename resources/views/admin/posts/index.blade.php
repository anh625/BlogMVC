@extends('admin.layouts.master')
@section('title', 'Danh sách bài viết')

@section('content')
    <div class="container py-2">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-light fw-semibold">
                Lọc & tìm kiếm bài viết
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.posts.index') }}">
                    <div class="row g-4 align-items-end">
                        <div class="col-12 col-md-4">
                            <label for="keyword" class="form-label fw-semibold mb-1">Tìm kiếm</label>
                            <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}"
                                class="form-control form-control-sm" placeholder="Tìm theo tiêu đề bài viết..."
                                aria-label="Tìm kiếm bài viết theo tiêu đề">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="status" class="form-label fw-semibold mb-1">Trạng thái</label>
                            <select id="status" name="status" class="form-select form-select-sm"
                                aria-label="Chọn trạng thái bài viết">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Công khai</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Lưu trữ</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-3">
                            <label for="category_id" class="form-label fw-semibold mb-1">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-select form-select-sm"
                                aria-label="Chọn danh mục bài viết">
                                <option value="all">Tất cả</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{-- {{ request('category_id') == $category->id ? 'selected' : '' }} --}}
                                        >
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-primary flex-grow-1" aria-label="Lọc bài viết">
                                <i class="bi bi-filter me-1"></i> Lọc
                            </button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1"
                                aria-label="Đặt lại bộ lọc">
                                <i class="bi bi-x-circle me-1"></i> Đặt lại
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="table-responsive shadow-sm border rounded">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th class="text-start">Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Người tạo</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="text-center">
                            <td>{{ $post->post_id }}</td>
                            <td class="text-start">{{ $post->title }}</td>
                            <td>{{ $post->category->category_name ?? '---' }}</td>
                            <td>{{ $post->user->name ?? '---' }}</td>
                            <td>{{ $post->view_counts }}</td>
                            <td>
                                <form action="{{ route('posts.updateStatus', $post->post_id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="post_status" class="form-select form-select-sm"
                                        onchange="this.form.submit()">
                                        <option value="1" {{ $post->post_status === 1 ? 'selected' : '' }}>Công khai
                                        </option>
                                        <option value="0" {{ $post->post_status === 0 ? 'selected' : '' }}>Lưu trữ
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.posts.detail', $post->post_id) }}"
                                    class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="tooltip"
                                    title="Xem chi tiết bài viết">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('posts.destroy', $post->post_id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip"
                                        title="Xóa bài viết">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Không có bài viết nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $posts->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
