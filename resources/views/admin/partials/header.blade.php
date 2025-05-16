<nav class="navbar navbar-light bg-light px-4">
    <span class="navbar-brand mb-0 h1">Trang quản trị</span>
    <div>
        <span class="me-3">Xin chào, {{ Auth::user()->name ?? 'Admin' }}</span>
        <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">
            Đăng xuất
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</nav>
