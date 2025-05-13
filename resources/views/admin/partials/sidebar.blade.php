<div class="sidebar p-3 bg-light border-end" style="min-height: 100vh;">
    <h5 class="mb-4 text-primary text-uppercase">Quản trị</h5>

    <ul class="nav flex-column nav-pills">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard.index') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

            {{-- <li class="nav-item mb-2">
                <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Tài khoản
                </a>
            </li> --}}

        <li class="nav-item mb-2">
            <a href="{{ route('admin.posts.index') }}"
               class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text me-2"></i> Bài viết
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i> Danh mục
            </a>
        </li>
    </ul>
</div>
