@extends('layouts.master')
@section('title', 'Quản lý tài khoản')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách người dùng</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Tên</th><th>Email</th><th>Ngày tạo</th><th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá?')">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
