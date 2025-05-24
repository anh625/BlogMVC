@extends('admin.layouts.master')
@section('title', 'Sửa danh mục')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chỉnh sửa danh mục</h5>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-light">← Quay lại danh sách</a>
        </div>

        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="mb-2">Vui lòng kiểm tra lại dữ liệu:</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="category_name"
                        id="category_name"
                        class="form-control @error('category_name') is-invalid @enderror"
                        value="{{ old('category_name', $category->category_name) }}"
                        required
                    >
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Cập nhật</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
