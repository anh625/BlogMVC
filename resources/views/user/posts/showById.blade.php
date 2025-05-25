@extends('user.layouts.app')
@section('content')
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ asset('storage/'.$data['post']->banner_image) }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $data['post']->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            @php
                                $avatar = 'images/users/avatar/default.png';
                                if($data['post']->user->user_image) $avatar = $data['post']->user->user_image;
                            @endphp
                            <a href="{{ route('posts.showByUserId',$data['post']->user_id) }}">
                            <figure class="author-figure mb-0 me-3 d-inline-block"><img src="{{ asset('storage/'.$avatar) }}" alt="Image" class="img-fluid"></figure>
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
                        <p>Categories:  <a href="{{ asset(route('posts.showByCategoryId', $data['post']->category_id)) }}"> {{ $data['post']->category->category_name }}</a></p>
                    </div>

                    {{-- Comment --}}
                    <div class="pt-5 comment-wrap">
                        <ul class="comment-list">
                            @foreach ($data['post']->comments as $cmt)
                                @if($cmt->user->is_active != null)
                                <li class="comment">
                                    <div class="vcard">
                                        @php
                                        $CmtAvatar = 'images/users/avatar/default.png';
                                        if($cmt->user->user_image) $CmtAvatar = $cmt->user->user_image;
                                        @endphp
                                        <img src="{{asset('storage/'. $CmtAvatar) }}"
                                            alt="Avatar">
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{ $cmt->user->name }}</h3>
                                        <div class="meta">{{ $cmt->created_at->format('d/m/Y \l\ú\c H:i') }}</div>
                                        <p>{{ $cmt->cmt_content }}</p>
                                        {{-- <p><a href="#" class="reply rounded">Reply</a></p> --}}
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>

                        <!-- END comment-list -->
                        {{-- Form Comment --}}

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            @if(session('user'))
                            <form action="{{ route('comments.store', ['id' => $data['post']->post_id]) }}" method="POST"
                                class="p-5 bg-light">
                                @csrf
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="cmt_content" id="message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn btn-primary">
                                </div>
                            </form>
                            @else
                                <p class="text-danger">Cần đăng nhập để tiếp tục</p>
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
