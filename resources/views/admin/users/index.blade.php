@extends('admin.layouts.master')
@section('title', 'Quản lý tài khoản')

@section('content')
    <div class="container py-2">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-light fw-semibold">
                Lọc & tìm kiếm người dùng
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.users.search') }}">
                    <div class="row g-4 align-items-end">
                        <div class="col-12 col-md-6">
                            <label for="search" class="form-label fw-semibold mb-1">Tìm kiếm</label>
                            <input type="text" id="key_word" name="key_word" value="{{ request('key_word') }}"
                                class="form-control form-control-sm" placeholder="Tìm kiếm theo tên..."
                                aria-label="Tìm kiếm người dùng theo tên hoặc email">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="is_active" class="form-label fw-semibold mb-1">Trạng thái</label>
                            <select id="is_active" name="is_active" class="form-select form-select-sm"
                                aria-label="Chọn trạng thái">
                                <option value=""
                                    {{ request('is_active') === null || request('is_active') === 'all' ? 'selected' : '' }}>Tất
                                    cả</option>
                                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Hoạt động
                                </option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tạm khóa
                                </option>
                            </select>
                        </div>

                        <div class="col-12 col-md-2 d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary flex-grow-1" aria-label="Lọc người dùng">
                                <i class="bi bi-filter me-1"></i> Lọc
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1"
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
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Quyền truy cập</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="text-center">
                            <td style="width: 50px;">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="rounded-circle"
                                        width="40" height="40" />
                                @else
                                    <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td>{{ $user->phone_number ?? '-' }}</td>
                            <td>
                                @if ($user->is_admin === 'admin')
                                    <span class="badge bg-success">Admin</span>
                                @else
                                    <span class="badge bg-secondary">Người dùng</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.users.updateUserStatus', $user->user_id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn thay đổi trạng thái người dùng này?')">
                                    @csrf
                                    <input type="hidden" name="user_status" value="{{ $user->is_active ? 0 : 1 }}">
                                    <button type="submit"
                                        class="btn btn-sm {{ $user->is_active ? 'btn-outline-success' : 'btn-outline-danger' }}">
                                        <i class="bi {{ $user->is_active ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                        {{ $user->is_active ? 'Hoạt động' : 'Tạm khóa' }}
                                    </button>
                                </form>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                    title="Xem chi tiết người dùng">
                                    <i class="bi bi-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
<div class="mt-3">
    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>


@endsection
