{{-- resources/views/posts/form.blade.php --}}
<!-- Bootstrap -->
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}

<input type="text" name="title" class="form-control mb-2" placeholder="Tiêu đề" value="{{ old('title', $post->title ?? '') }}" required>

<input type="text" name="description" class="form-control mb-2" placeholder="Mô tả" value="{{ old('description', $post->description ?? '') }}" required>

@if(isset($post) && $post->image)
    <img src="{{ asset('storage/' . $post->image) }}" width="120" class="mb-2"><br>
@endif
<label for="image" class="form-label">Chọn ảnh tiêu đề của bài viết</label>
<input type="file" name="image" class="form-control mb-2" {{ isset($post) ? '' : 'required' }}>
<small class="text-muted">Vui lòng chọn kích thước ảnh 164x164 để rõ nét nhất</small>
<br/>
<br/>

<textarea id="content" name="content" class="form-control mb-2" placeholder="Nội dung" rows="5" required>{{ old('content', $post->content ?? '') }}</textarea>

<select name="category_id" class="form-control mb-2" required>
    <option value="">-- Chọn danh mục --</option>
    @foreach($categories as $c)
        <option value="{{ $c['category_id'] }}" {{ (old('category_id', $post->category_id ?? '') == $c['category_id']) ? 'selected' : '' }}>
            {{ $c['category_name'] }}
        </option>
    @endforeach
</select>

<div class="form-check mb-2">
    <input type="checkbox" name="highlight_post" class="form-check-input" {{ old('highlight_post', $post->highlight_post ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Bài viết nổi bật</label>
</div>

<div class="form-check mb-2">
    <input type="checkbox" name="post_status" class="form-check-input" {{ old('post_status', $post->post_status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Hiển thị</label>
</div>
