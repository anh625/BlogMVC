<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng bài viết</title>
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'image code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | image code',
            height: 600,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        const file = this.files[0];
                        const reader = new FileReader();
                        reader.onload = function () {
                            const base64 = reader.result;
                            cb(base64, { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        });
    </script>
</head>
<body>
<h1>Đăng bài viết mới</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <label>Tiêu đề:</label><br>
    <input type="text" name="title" required style="width: 100%;"><br><br>

    <label>Nội dung:</label><br>
    <textarea name="content" id="content"></textarea><br><br>

    <button type="submit">Đăng bài</button>
</form>
</body>
</html>
