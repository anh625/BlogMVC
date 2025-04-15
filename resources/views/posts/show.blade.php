<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>
<body>
<h1>{{ $post->title }}</h1>
<hr>
<div>{!! $post->content !!}</div> <!-- Render HTML an toàn -->

<br><a href="{{ route('posts.create') }}">← Quay lại đăng bài</a>
</body>
</html>
