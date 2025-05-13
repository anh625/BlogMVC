@extends('admin.layouts.master')
@section('title', 'Quản lý danh mục')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh sách danh mục</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Thêm danh mục mới</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col" class="text-center" style="width: 150px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->category_id }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Chưa có danh mục nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
