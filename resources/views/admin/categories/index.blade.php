@extends('admin.layouts.master')
@section('title', 'Quản lý danh mục')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Thêm danh mục mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center text-uppercase small">
                    <tr>
                        <th scope="col" style="width: 80px;">ID</th>
                        <th scope="col" class="text-start">Tên danh mục</th>
                        <th scope="col" style="width: 180px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="text-center fw-semibold">{{ $category->category_id }}</td>
                            <td class="text-start">{{ $category->category_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category->category_id) }}"
                                   class="btn btn-sm btn-outline-warning me-2"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa danh mục">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('Bạn có chắc chắn muốn xoá danh mục này?')"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá danh mục">
                                        <i class="bi bi-trash"></i> Xoá
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted fst-italic py-4">Chưa có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
