

<div class="container mt-4">
    <h2 class="mb-4">Thêm danh mục</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Vui lòng kiểm tra lại dữ liệu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Tên danh mục</label>
            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_slug" class="form-label">Slug (tuỳ chọn)</label>
            <input type="text" name="category_slug" class="form-control" id="category_slug" value="{{ old('category_slug') }}">
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
