@extends('admin.layouts.master')
@section('title', 'Danh sách bài viết')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách bài viết</h5>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
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
                            <tr>
                                <td>{{ $post->post_id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->category_name ?? '---' }}</td>
                                <td>{{ $post->user->name ?? '---' }}</td>
                                <td>{{ $post->view_counts }}</td>
                                <td>
                                    <form action="{{ route('posts.updateStatus', $post->post_id) }}" method="POST"
                                        class="d-flex align-items-center gap-1">
                                        @csrf
                                        @method('PUT')
                                        <select name="post_status" onchange="this.form.submit()"
                                            class="form-select form-select-sm">
                                            <option value="1" {{ $post->post_status === 1 ? 'selected' : '' }}>Công
                                                khai</option>
                                            <option value="0" {{ $post->post_status === 0 ? 'selected' : '' }}>Lưu
                                                trữ</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td class="d-flex gap-1">
                                    {{-- Xem chi tiết --}}
                                    <a href="{{ route('admin.posts.detail', $post->post_id) }}" class="btn btn-sm btn-info">
                                        Xem
                                    </a>

                                    {{-- Xoá bài viết --}}
                                    <form action="{{ route('posts.destroy', $post->post_id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Xoá
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có bài viết nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
