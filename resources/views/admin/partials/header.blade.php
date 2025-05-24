<nav class="navbar navbar-light bg-white border-bottom px-4 py-3 shadow-sm">
    <span class="navbar-brand mb-0 h5 text-uppercase text-primary fw-bold">
        {{ $currentTitle ?? 'Trang quản trị' }}
    </span>

    <div class="d-flex align-items-center">
        <span class="me-3 text-muted">
            Xin chào, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
        </span>
        <form action="{{ route('logout') }}" method="GET" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
            </button>
        </form>
    </div>
</nav>
