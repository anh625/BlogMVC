<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .main-content {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')
    <div class="main-content">
        @include('admin.partials.header')
        <main class="p-4">
            @yield('content')
        </main>
        {{-- @include('admin.partials.footer') --}}
    </div>
</body>
</html>
