@extends('admin.layouts.master')
@section('title', 'Thêm danh mục')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thêm danh mục mới</h5>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-light">← Quay lại danh sách</a>
        </div>

        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="category_name"
                        id="category_name"
                        class="form-control @error('category_name') is-invalid @enderror"
                        value="{{ old('category_name') }}"
                        required
                    >
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Lưu danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
