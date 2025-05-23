<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{ route('posts.show') }}" class="logo m-0 float-start">Blogy<span class="text-primary">.</span></a>
                    </div>
                    <div class="col-8 text-center">
                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            <li><a href="{{ route('posts.show') }}">Home</a></li>
                            <li class="has-children active">
                                <a href="{{ route('posts.show') }}">Pages</a>
{{--                                <ul class="dropdown">--}}
{{--                                    <li><a href="search-result.html">Search Result</a></li>--}}
{{--                                    <li><a href="blog.html">Blog</a></li>--}}
{{--                                    <li><a href="single.html">Blog Single</a></li>--}}
{{--                                    <li class="active"><a href="category.html">Category</a></li>--}}
{{--                                    <li><a href="about.html">About</a></li>--}}
{{--                                    <li><a href="contact.html">Contact Us</a></li>--}}
{{--                                    <li><a href="#">Menu One</a></li>--}}
{{--                                    <li><a href="#">Menu Two</a></li>--}}
{{--                                    <li class="has-children">--}}
{{--                                        <a href="#">Dropdown</a>--}}
{{--                                        <ul class="dropdown">--}}
{{--                                            <li><a href="#">Sub Menu One</a></li>--}}
{{--                                            <li><a href="#">Sub Menu Two</a></li>--}}
{{--                                            <li><a href="#">Sub Menu Three</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </li>
{{--                            <li><a href="category.html">Culture</a></li>--}}
{{--                            <li><a href="services.html">Business</a></li>--}}
{{--                            <li><a href="about.html">Politics</a></li>--}}
                        </ul>
                    </div>
                    <div class="col-2 text-end">
                        <a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                        <form action="{{ route('posts.searchByTitle') }}" class="search-form d-none d-lg-inline-block">
                            <input type="text" name="title" class="form-control" placeholder="Search...">
                            <span type="submit" class="bi-search" id="search-btn"></span>
                            <script>
                                document.getElementById('search-btn').addEventListener('click', function () {
                                    this.closest('form').submit();
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
@if(request()->path() == 'posts')
    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Blog</h1>
                </div>
            </div>
        </div>
    </div>
@endif

