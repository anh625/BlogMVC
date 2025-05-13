{{-- resources/views/posts/form.blade.php --}}
<!-- Bootstrap -->
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}

<input type="text" name="title" class="form-control mb-2" placeholder="Tiêu đề" value="{{ old('title', $post->title ?? '') }}" required>

<input type="text" name="description" class="form-control mb-2" placeholder="Mô tả" value="{{ old('description', $post->description ?? '') }}" required>


<label for="image" class="form-label">Choose thumbnail</label>
<div>
    <input type="file" id="titleImg" class="form-control mb-2" {{ isset($post) ? '' : 'required' }}>
    <div style="width: 300px; height: 300px;">
        @if(isset($post) && $post->image)
            <img id="titleImgPreview" src="{{ asset('storage/' . $post->image) }}" style="max-width: 100%;" class="mb-2" alt="Posts image"><br>
        @else
            <img id="titleImgPreview" style="max-width: 100%;" class="mb-2" >
        @endif
    </div>
</div>
<!-- Input ẩn để gửi dữ liệu ảnh đã crop -->
<input type="hidden" name="thumbnail" id="cropped_image">
<br/>
<br/>

<label for="image" class="form-label">Choose banner</label>
<div>
    <input type="file" id="bannerImg" class="form-control mb-2" {{ isset($post) ? '' : 'required' }}>
    <div style="width: 100%; max-width: 100vw; height: 298px; overflow: hidden;">
        @if(isset($post) && $post->image)
            <img  id="bannerImgPreview" src="{{ asset('storage/' . $post->image) }}" style="max-width: 100%;" class="mb-2" alt="Posts image"><br>
        @else
            <img id="bannerImgPreview" style="max-width: 100%;" class="mb-2" >
        @endif
    </div>
</div>
<!-- Input ẩn để gửi dữ liệu ảnh đã crop -->
<input type="hidden" name="banner_image" id="cropped_banner_image">
<br/>
<br/>

<textarea id="content" name="content" class="form-control mb-2" placeholder="Nội dung" rows="5" required>{{ old('content', $post->content ?? '') }}</textarea>

<select name="category_id" class="form-control mb-2" required>
    <option value="">-- Choose category --</option>
    @foreach($categories as $c)
        <option value="{{ $c['category_id'] }}" {{ (old('category_id', $post->category_id ?? '') == $c['category_id']) ? 'selected' : '' }}>
            {{ $c['category_name'] }}
        </option>
    @endforeach
</select>
@php
    use Illuminate\Support\Str;
@endphp
<input type="hidden" name="post_status" value="0">
<div class="form-check mb-2">
    <input type="checkbox" name="post_status" class="form-check-input" value="1"
        {{ old('post_status', $post->post_status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Show</label>
</div>
<script>
    let cropper, bannerCropper;
    document.getElementById('titleImg').addEventListener('change', function (e) {
        const image = document.getElementById('titleImgPreview');
        const file = e.target.files[0];
        const imageUrl = URL.createObjectURL(file);
        image.onload = function () {
            if (cropper) cropper.destroy();
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                background: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                ready() {
                    const cropBox = this.cropper.cropBox;
                    cropBox.style.borderRadius = '5%';
                    cropBox.style.overflow = 'hidden';
                }
            });
        };
        image.src = imageUrl;
    });

    document.getElementById('bannerImg').addEventListener('change', function (e) {
        const image = document.getElementById('bannerImgPreview');
        const file = e.target.files[0];
        const imageUrl = URL.createObjectURL(file);
        image.onload = function () {
            if (bannerCropper) bannerCropper.destroy();
            bannerCropper = new Cropper(image, {
                aspectRatio: window.innerWidth / 298, // width:height
                viewMode: 1,
                dragMode: 'move',
                background: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                ready() {
                    const cropper = this.cropper;
                    const containerData = cropper.getContainerData();

                    cropper.setCropBoxData({
                        width: containerData.width,
                        height: 298
                    });
                }
            });
        };
        image.src = imageUrl;
    });

    document.getElementById('postForm').addEventListener('submit', function (e) {
         // Ngăn form gửi ngay

        if (cropper || bannerCropper) {
            e.preventDefault();

            if (cropper) {
                const canvas = cropper.getCroppedCanvas();
                if (!canvas) {
                    alert('Không thể crop ảnh thumbnail!');
                    return;
                }
                document.getElementById('cropped_image').value = canvas.toDataURL('image/png');
            }

            if (bannerCropper) {
                const canvasBanner = bannerCropper.getCroppedCanvas({
                    width: window.innerWidth,
                    height: 298
                });
                if (!canvasBanner) {
                    alert('Không thể crop ảnh banner!');
                    return;
                }
                document.getElementById('cropped_banner_image').value = canvasBanner.toDataURL('image/png');
            }

            this.submit();
        }
    });
</script>
