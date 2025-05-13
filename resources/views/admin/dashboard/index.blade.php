@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Bảng điều khiển</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng bài viết</h5>
                    {{-- <p class="card-text fs-4">{{ $postCount }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng người dùng</h5>
                    {{-- <p class="card-text fs-4">{{ $userCount }}</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
