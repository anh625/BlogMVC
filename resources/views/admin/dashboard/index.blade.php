@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="row g-4">

        {{-- Người dùng hoạt động --}}
        <div class="col-md-6 col-lg-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-success">
                    <h6 class="card-title">Người dùng hoạt động</h6>
                    <h3 class="fw-bold">{{ $active_users }}</h3>
                    <a href="{{ route('admin.users.index', ['status' => 1]) }}" class="btn btn-sm btn-outline-success mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>

        {{-- Người dùng bị khóa --}}
        <div class="col-md-6 col-lg-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-danger">
                    <h6 class="card-title">Người dùng bị khóa</h6>
                    <h3 class="fw-bold">{{ $inactive_users }}</h3>
                    <a href="{{ route('admin.users.index', ['status' => 0]) }}" class="btn btn-sm btn-outline-danger mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>

        {{-- Bài viết hoạt động --}}
        <div class="col-md-6 col-lg-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-primary">
                    <h6 class="card-title">Bài viết đang hoạt động</h6>
                    <h3 class="fw-bold">{{ $active_posts }}</h3>
                    <a href="{{ route('admin.posts.index', ['status' => 1]) }}" class="btn btn-sm btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>

        {{-- Bài viết lưu trữ --}}
        <div class="col-md-6 col-lg-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-body text-secondary">
                    <h6 class="card-title">Bài viết đã lưu trữ</h6>
                    <h3 class="fw-bold">{{ $archived_posts }}</h3>
                    <a href="{{ route('admin.posts.index', ['status' => 0]) }}" class="btn btn-sm btn-outline-secondary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
