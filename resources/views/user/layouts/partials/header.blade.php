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
                            @php
                                $url =''
                            @endphp
                            @if(Route::currentRouteName() === 'posts.show')
                                @php
                                    $url = 'home'
                                @endphp
                            @elseif(Route::currentRouteName() === 'posts.showByCategoryId')
                                @php
                                    $url = 'category'
                                @endphp
                            @elseif(Route::currentRouteName() === 'contact.index')
                                @php
                                    $url = 'contact'
                                @endphp
                            @endif
                            <li class="{{ $url == 'home'? 'active': '' }} " >
                                <a href="{{ route('posts.show') }}">Home</a></li>
                            <li class="has-children {{ $url == 'category'? 'active': '' }}">
                                <a href="#">Category</a>
                                    <ul class="dropdown">
                                        @foreach($allCategories as $c)
                                            <li><a href="{{ route('posts.showByCategoryId', $c['category_id']) }}"> {{ $c['category_name'] }} </a></li>
                                        @endforeach
                                    </ul>
                            </li>
                            <li class="{{ $url == 'contact'? 'active': '' }}">
                                <a href="{{ route('contact.index') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-2 text-end d-flex gap-3">
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
                        @if(session()->has('user'))
                        <ul class="d-none d-lg-inline-flex  align-items-center  site-menu">
                            @php
                                $avatar = 'images/users/avatar/default.png';
                                if(session()->has('user') && \App\Session\UserSession::getUser()['user_image'])
                                    $avatar = \App\Session\UserSession::getUser()['user_image'];
                                $name = \App\Session\UserSession::getUser()['name'];
                            @endphp
                            <li class="has-children active">
                                <img src="{{ asset('storage/'.$avatar) }}" alt="avatar"
                                     id="avatar" class="avatar"/>
                            <ul class="dropdown" style="margin-left: -70px; margin-top: 10px; padding: 0">
                                <li class="hover-gray"><a href="{{ route('user.index') }}"
                                        style="font-size: 20px;font-weight: 525;">
{{--                                        <img src="{{ asset('storage/'.$avatar) }}" alt="avatar"--}}
{{--                                             id="avatar" class="avatar"/><br>--}}
                                        {{ $name }}
                                    </a></li>
                                <li class="hover-gray">
                                    <a
                                        href="{{ route('user.edit') }}"
                                        style="font-size: 20px;font-weight: 525;">
                                        Edit profile
                                    </a></li>
                                <li class="hover-gray"><a href="{{ route('logout') }}"
                                        style="font-size: 20px;font-weight: 525;">Log Out
                                    </a></li>
                            </ul>
                            </li>
                        </ul>
                        @else
                        <div class="d-none d-lg-inline-flex  align-items-center text-#fbfae9">
                            <a class="login-link" href="{{ route('sign-in') }}">Login</a>
                        </div>
                        @endif
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

<style>
    .hover-gray {
        transition: all 0.2s ease;      /* Hiệu ứng mượt */
    }

    .hover-gray:hover {
        background-color: #f0f0f0;      /* Màu xám khi hover */
    }

    .login-link {
        color: #fbfae9;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .login-link:hover {
        color: #ffffff;
        text-decoration: underline;
        font-weight: bold;
    }

    .avatar{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ccc;
        display: inline-block;
        margin-right: 10px;
    }
</style>
<script>
    document.getElementById("avatar").addEventListener("click", function () {
        window.location.href = '{{ route('user.index') }}'
    });
</script>
