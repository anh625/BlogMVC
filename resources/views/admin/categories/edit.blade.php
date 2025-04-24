
<div class="container">
    <h2>Sửa danh mục</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_name">Tên danh mục</label>
            <input type="text" name="category_name" id="category_name" class="form-control"
                   value="{{ old('category_name', $category->category_name) }}" required>
        </div>

        <div class="form-group">
            <label for="category_slug">Slug</label>
            <input type="text" name="category_slug" id="category_slug" class="form-control"
                   value="{{ old('category_slug', $category->category_slug) }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
