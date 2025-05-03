{{-- resources/views/posts/edit.blade.php --}}
@extends('layouts.app')


@section('content')
    <div class="container py-4">
        <h2>Sửa thông tin cá nhân</h2>

        <form id="profile" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="image" class="form-label">Chọn ảnh đại diện</label>
            <div>
                <input type="file" id="titleImg" class="form-control mb-2">
                <div style="width: 300px; height: 300px;">
                    @if(isset($user) && $user->user_image)
                        <img id="titleImgPreview" src="{{ asset('storage/' . $user->user_image) }}" style="max-width: 100%;" class="mb-2" alt="avatar"><br>
                    @else
                        <img id="titleImgPreview" style="max-width: 100%;" class="mb-2" >
                    @endif
                </div>
            </div>
            <!-- Input ẩn để gửi dữ liệu ảnh đã crop -->
            <br/>
            <br/>
            
            <input type="hidden" name="avatar" id="cropped_image">

            <input type="text" name="name" class="form-control mb-2" placeholder="Họ và tên" value="{{ $user->name }}" required>


            <input type="number" id="phone" name="phone_number" class="form-control mb-2" placeholder="Số điện thoại" value="{{ $user->phone_number }}" required/>

            <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-2">Quay lại</a>
        </form>
    </div>
    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <script>

        let cropper;
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
                        cropBox.style.borderRadius = '50%';
                        cropBox.style.overflow = 'hidden';
                    }
                });
            };
            image.src = imageUrl;
        });
        document.getElementById('profile').addEventListener('submit', function (e) {
            // Ngăn form gửi ngay
            if (cropper) {
                e.preventDefault();
                const canvas = cropper.getCroppedCanvas();
                if (!canvas) {
                    alert('Không thể crop ảnh!');
                    return;
                }

                // Gán dữ liệu base64 vào input ẩn
                document.getElementById('cropped_image').value = canvas.toDataURL('image/png');

                // Gửi form thủ công sau khi đã gán xong dữ liệu
                //console.log(document.getElementById('cropped_image').value)
                this.submit();
            }
        });
    </script>
@endsection

