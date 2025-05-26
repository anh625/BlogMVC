@extends('user.layouts.app')
@section('content')
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ asset('storage/' . $data['post']->banner_image) }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $data['post']->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            @php
                                $avatar = 'images/users/avatar/default.png';
                                if ($data['post']->user->user_image) {
                                    $avatar = $data['post']->user->user_image;
                                }
                            @endphp
                            <a href="{{ route('posts.showByUserId', $data['post']->user_id) }}">
                                <figure class="author-figure mb-0 me-3 d-inline-block"><img
                                        src="{{ asset('storage/' . $avatar) }}" alt="Image" class="img-fluid"></figure>
                            </a>
                            <span class="d-inline-block mt-1">By {{ $data['post']->user->name }}</span>
                            <span>&nbsp;-&nbsp; {{ $data['post']->updated_at->format('F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">

                    <div class="post-content-body">
                        {!! $data['post']->content !!}
                    </div>


                    <div class="pt-5">
                        <p>Categories: <a href="{{ asset(route('posts.showByCategoryId', $data['post']->category_id)) }}">
                                {{ $data['post']->category->category_name }}</a></p>
                    </div>

                    {{-- Comment --}}
                    <div class="pt-5 comment-wrap">
                        <h5 class="mb-4">Bình luận ({{ $data['post']->comments->count() }})</h5>

                        <ul class="list-unstyled">
                            @foreach ($data['post']->comments as $cmt)
                                @if ($cmt->user->is_active)
                                    @php
                                        $CmtAvatar = $cmt->user->user_image
                                            ? asset('storage/' . $cmt->user->user_image)
                                            : asset('images/users/avatar/default.png');
                                    @endphp

                                    <li class="d-flex mb-4 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $CmtAvatar }}" alt="Avatar" class="rounded-circle"
                                                style="width: 48px; height: 48px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0">{{ $cmt->user->name }}</h6>
                                                <small class="text-muted">{{ $cmt->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 text-body">{{ $cmt->cmt_content }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <!-- END comment-list -->
                        {{-- Form Comment --}}

                        <div class="comment-form-wrap mt-5">
                            <h5 class="mb-3">Leave a comment</h5>

                            @if (session('user'))
                                <form action="{{ route('comments.store', ['id' => $data['post']->post_id]) }}"
                                    method="POST" class="border p-3 rounded bg-light shadow-sm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="message" class="form-label fw-semibold">Message</label>
                                        <textarea name="cmt_content" id="message" rows="4" class="form-control" placeholder="Nhập nội dung tại đây..."
                                            required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-send me-1"></i> Send
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning small mb-0">
                                    Vui lòng <a href="{{ route('login') }}" class="text-decoration-underline">đăng nhập</a>
                                    để bình luận.
                                </div>
                            @endif
                        </div>


                    </div>

                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @if (is_object($data['popularPosts']))
                                    @foreach ($data['popularPosts'] as $p)
                                        <li>
                                            <a href="{{ route('posts.showById', $p->post_id) }}" class="d-flex">
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="Image placeholder"
                                                    class="me-4 rounded">
                                                <div class="text">
                                                    <h4>{{ $p->title }}</h4>
                                                    <div class="post-meta">
                                                        <span class="mr-2">{{ $p->updated_at->format('F j, Y') }} </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            @if ($data['categories'] instanceof \Illuminate\Support\Collection)
                                @foreach ($data['categories'] as $c)
                                    <li><a href="{{ route('posts.showByCategoryId', $c['category_id']) }}">{{ $c['category_name'] }}
                                            <span>({{ $c['count_post'] }})
                                            </span></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- END sidebar-box -->
                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>
@endsection
