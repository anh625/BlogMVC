<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
            },
            setup: function (editor) {
                // Đồng bộ nội dung khi submit form
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>

    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">

</head>
<body>
@include('user.layouts.partials.header')

        @yield('content')

@include('user.layouts.partials.footer')
@include('user.layouts.partials.preloader')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tiny-slider.js') }}"></script>
<script src="{{ asset('js/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/glightbox.min.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/counter.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            const bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();

            // Tự động ẩn toast sau 5 giây
            setTimeout(() => {
                bootstrapToast.hide();
            }, 5000);
        });
    });
</script>
@if(session('error'))
    <x-toast :toasts="[
    ['title' => 'Error!', 'message' => session('error'), 'type' => 'danger']
]" />
@endif
@if(session('success'))
    <x-toast :toasts="[
    ['title' => 'Success!', 'message' => session('success'), 'type' => 'success']
]" />
@endif


</body>
</html>


