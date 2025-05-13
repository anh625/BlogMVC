{{-- resources/views/posts/index.blade.php --}}
@extends('user.layouts.app')
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="section search-result-wrap">
        <div class="container">
    @if(Route::currentRouteName() === 'posts.showByCategoryId')
        <div class="row">
            <div class="col-12">
                <div class="heading">Category: {{ $data['category_name'] }} </div>
            </div>
        </div>
    @elseif(Route::currentRouteName() === 'posts.searchByTitle')
        <div class="row">
            <div class="col-12">
                <div class="heading">Result: {{ $data['title'] }} </div>
            </div>
        </div>
    @endif
        <div class="row posts-entry">
            <div class="col-lg-8">
                    @if(is_object($data['posts']))
                        @foreach($data['posts'] as $p)
                            <div class="blog-entry d-flex blog-entry-search-item">
                                <a href="{{ asset(route('posts.showById', $p->post_id)) }}" class="img-link me-4">
                                    <img style="max-width: 230px; max-height: 230px; object-fit: contain;" src="{{ asset('storage/' . $p->image) }}" alt="Image" class="img-fluid">
                                </a>
                                <div>
                                    <span class="date">{{ $p->updated_at->format('M. jS, Y') }} &bullet; <a href="{{ route('posts.showByCategoryId', $p->category_id) }}">{{ $p->category->category_name }}</a></span>
                                    <h2><a href="{{ asset(route('posts.showById', $p->post_id)) }}">{{ $p->title }}</a></h2>
                                    <p>{{ $p->description }}</p>
                                    <p><a href="{{ asset(route('posts.showById', $p->post_id)) }}" class="btn btn-sm btn-outline-primary">Read More</a></p>
                                </div>
                            </div>
                        @endforeach
                    @elseif(is_string($data['posts']))
                        {{ $data['posts'] }}
                    @endif



                    <div class="row text-start pt-5 border-top">
                        <div class="col-md-12">
                            @if ($data['posts'] instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $data['posts']->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>

                </div>

            <div class="col-lg-4 sidebar">

                    <!-- END sidebar-box -->
                <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @if(is_object($data['popularPosts']))
                                    @foreach($data['popularPosts'] as $p)
                                        <li>
                                            <a href="{{ route('posts.showById', $p->post_id) }}" class="d-flex">
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="Image placeholder" class="me-4 rounded">
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
                        @if($data['categories'] instanceof \Illuminate\Support\Collection)
                            @foreach($data['categories'] as $c)
                                <li><a href="{{ route('posts.showByCategoryId', $c['category_id']) }}">{{ $c['category_name'] }} <span>({{ $c['count_post'] }})
                                        </span></a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                    <!-- END sidebar-box -->

                <div class="sidebar-box">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            @if($data['categories'] instanceof \Illuminate\Support\Collection)
                                @foreach($data['categories'] as $c)
                                    <li><a href="{{ route('posts.showByCategoryId', $c['category_id']) }}">
                                            {{ $c['category_name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
            </div>
        </div>
        </div>
    </div>
@endsection
