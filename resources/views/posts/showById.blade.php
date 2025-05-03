@extends('layouts.app')
@section('content')
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ asset('storage/'.$data['post']->image) }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $data['post']->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 me-3 d-inline-block"><img src="images/person_1.jpg"
                                    alt="Image" class="img-fluid"></figure>
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
                        {{-- <h3 class="mb-5 heading">6 Comments</h3> --}}
                        {{-- <ul class="comment-list">

                            <li class="comment">
                                <div class="vcard">
                                    <img src="images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>
                            </li>

                            <li class="comment">
                                <div class="vcard">
                                    <img src="images/person_2.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>

                                <ul class="children">
                                    <li class="comment">
                                        <div class="vcard">
                                            <img src="images/person_3.jpg" alt="Image placeholder">
                                        </div>
                                        <div class="comment-body">
                                            <h3>Jean Doe</h3>
                                            <div class="meta">January 9, 2018 at 2:21pm</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem
                                                laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe
                                                enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?
                                            </p>
                                            <p><a href="#" class="reply rounded">Reply</a></p>
                                        </div>


                                        <ul class="children">
                                            <li class="comment">
                                                <div class="vcard">
                                                    <img src="images/person_4.jpg" alt="Image placeholder">
                                                </div>
                                                <div class="comment-body">
                                                    <h3>Jean Doe</h3>
                                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur
                                                        quidem laborum necessitatibus, ipsam impedit vitae autem, eum
                                                        officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum
                                                        impedit necessitatibus, nihil?</p>
                                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                                </div>

                                                <ul class="children">
                                                    <li class="comment">
                                                        <div class="vcard">
                                                            <img src="images/person_5.jpg" alt="Image placeholder">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>Jean Doe</h3>
                                                            <div class="meta">January 9, 2018 at 2:21pm</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Pariatur quidem laborum necessitatibus, ipsam impedit vitae
                                                                autem, eum officia, fugiat saepe enim sapiente iste iure!
                                                                Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                            <p><a href="#" class="reply rounded">Reply</a></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="comment">
                                <div class="vcard">
                                    <img src="images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Jean Doe</h3>
                                    <div class="meta">January 9, 2018 at 2:21pm</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>
                            </li>
                        </ul> --}}
                        <ul class="comment-list">
                            @foreach ($data['post']->comments as $cmt)
                                <li class="comment">
                                    <div class="vcard">
                                        <img src="{{ $cmt->user->avatar ?? asset('images/default_avatar.jpg') }}"
                                            alt="Avatar">
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{ $cmt->user->name }}</h3>
                                        <div class="meta">{{ $cmt->created_at->format('d/m/Y \l\ú\c H:i') }}</div>
                                        <p>{{ $cmt->cmt_content }}</p>
                                        {{-- <p><a href="#" class="reply rounded">Reply</a></p> --}}
                                    </div>
                                </li>
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
                    {{--                    <div class="sidebar-box search-form-wrap"> --}}
                    {{--                        <form action="#" class="sidebar-search-form"> --}}
                    {{--                            <span class="bi-search"></span> --}}
                    {{--                            <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter"> --}}
                    {{--                        </form> --}}
                    {{--                    </div> --}}
                    <!-- END sidebar-box -->
                    {{--                    <div class="sidebar-box"> --}}
                    {{--                        <div class="bio text-center"> --}}
                    {{--                            <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid mb-3"> --}}
                    {{--                            <div class="bio-body"> --}}
                    {{--                                <h2>Hannah Anderson</h2> --}}
                    {{--                                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p> --}}
                    {{--                                <p><a href="#" class="btn btn-primary btn-sm rounded px-2 py-2">Read my bio</a></p> --}}
                    {{--                                <p class="social"> --}}
                    {{--                                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a> --}}
                    {{--                                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a> --}}
                    {{--                                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a> --}}
                    {{--                                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a> --}}
                    {{--                                </p> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    <!-- END sidebar-box -->
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

                    <div class="sidebar-box">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            @if ($data['categories'] instanceof \Illuminate\Support\Collection)
                                @foreach ($data['categories'] as $c)
                                    <li><a href="{{ route('posts.showByCategoryId', $c['category_id']) }}">
                                            {{ $c['category_name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>

    <!-- Start posts-entry -->
    {{--    <section class="section posts-entry posts-entry-sm bg-light"> --}}
    {{--        <div class="container"> --}}
    {{--            <div class="row mb-4"> --}}
    {{--                <div class="col-12 text-uppercase text-black">More Blog Posts</div> --}}
    {{--            </div> --}}
    {{--            <div class="row"> --}}
    {{--                <div class="col-md-6 col-lg-3"> --}}
    {{--                    <div class="blog-entry"> --}}
    {{--                        <a href="single.html" class="img-link"> --}}
    {{--                            <img src="images/img_1_horizontal.jpg" alt="Image" class="img-fluid"> --}}
    {{--                        </a> --}}
    {{--                        <span class="date">Apr. 14th, 2022</span> --}}
    {{--                        <h2><a href="single.html">Thought you loved Python? Wait until you meet Rust</a></h2> --}}
    {{--                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> --}}
    {{--                        <p><a href="#" class="read-more">Continue Reading</a></p> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-md-6 col-lg-3"> --}}
    {{--                    <div class="blog-entry"> --}}
    {{--                        <a href="single.html" class="img-link"> --}}
    {{--                            <img src="images/img_2_horizontal.jpg" alt="Image" class="img-fluid"> --}}
    {{--                        </a> --}}
    {{--                        <span class="date">Apr. 14th, 2022</span> --}}
    {{--                        <h2><a href="single.html">Startup vs corporate: What job suits you best?</a></h2> --}}
    {{--                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> --}}
    {{--                        <p><a href="#" class="read-more">Continue Reading</a></p> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-md-6 col-lg-3"> --}}
    {{--                    <div class="blog-entry"> --}}
    {{--                        <a href="single.html" class="img-link"> --}}
    {{--                            <img src="images/img_3_horizontal.jpg" alt="Image" class="img-fluid"> --}}
    {{--                        </a> --}}
    {{--                        <span class="date">Apr. 14th, 2022</span> --}}
    {{--                        <h2><a href="single.html">UK sees highest inflation in 30 years</a></h2> --}}
    {{--                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> --}}
    {{--                        <p><a href="#" class="read-more">Continue Reading</a></p> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-md-6 col-lg-3"> --}}
    {{--                    <div class="blog-entry"> --}}
    {{--                        <a href="single.html" class="img-link"> --}}
    {{--                            <img src="images/img_4_horizontal.jpg" alt="Image" class="img-fluid"> --}}
    {{--                        </a> --}}
    {{--                        <span class="date">Apr. 14th, 2022</span> --}}
    {{--                        <h2><a href="single.html">Don’t assume your user data in the cloud is safe</a></h2> --}}
    {{--                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> --}}
    {{--                        <p><a href="#" class="read-more">Continue Reading</a></p> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    <!-- End posts-entry -->
@endsection
