<div class="sidebar bg-white border-end shadow-sm" style="min-height: 100vh; width: 250px;">
    <div class="p-4 border-bottom">
        <h6 class="text-uppercase text-primary fw-bold mb-0" style="letter-spacing: 0.05em;">Quản trị</h6>
    </div>

    <ul class="nav flex-column p-3 gap-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-people me-2"></i> Tài khoản
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.posts.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('admin.posts.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-file-earmark-text me-2"></i> Bài viết
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('admin.categories.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-tags me-2"></i> Danh mục
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.contacts.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('admin.contacts.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-headset me-2"></i> Trợ giúp
            </a>
        </li>
    </ul>
</div>
