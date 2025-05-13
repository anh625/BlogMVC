@extends('user.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>My post</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success">+ Add post</a>
        </div>

        @if(count($data['posts']) > 0)
            <div class="row posts-entry">
            <div class="col-lg-8">
                @if(is_object($data['posts']))
                    @foreach($data['posts'] as $p)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ asset(route('posts.showById', $p->post_id)) }}" class="img-link me-4">
                                <img style="max-width: 230px; max-height: 230px; object-fit: contain;" src="{{ asset('storage/' . $p->image) }}" alt="Image" class="img-fluid">
                            </a>
                            <div>
                                <span class="date">
                                    {{ $p->updated_at->format('M. jS, Y') }}
                                    &bullet; <a href="{{ route('posts.showByCategoryId', $p->category_id) }}">{{ $p->category->category_name }}</a>
                                    &bullet; {{ $p->view_counts }} views
                                    &bullet;
                                    @if($p->post_status)
                                        show
                                    @else
                                        hidden
                                    @endif

                                </span>
                                <h2><a href="{{ asset(route('posts.showById', $p->post_id)) }}">{{ $p->title }}</a></h2>
                                <p>{{ $p->description }}</p>
                                <p><a href="{{ asset(route('posts.showById', $p->post_id)) }}" class="btn btn-sm btn-outline-primary">Read More</a></p>
                                <a href="{{ route('posts.edit', $p->post_id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $p->post_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>

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
            </div>
        @else
            <p>No post.</p>
        @endif
    </div>
@endsection
