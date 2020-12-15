<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Hatem Mohamed Elsheref" />

    <!-- Stylesheets
    ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Istok+Web:400,700&display=swap" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/style.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{frontAssets('css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/magnific-popup.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{frontAssets('css/et-line.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{frontAssets('css/custom.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{frontAssets('css/colors.php?color=0474c4')}}" type="text/css" />

    <!-- Hosting Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{frontAssets('css/fonts.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{frontAssets('css/course.css')}}" type="text/css" />
    <!-- / -->

    <!-- Document Title
    ============================================= -->
    <title>{{config('general.application_name')}}</title>
@yield('css')
</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Top Bar
    ============================================= -->
    <div id="top-bar" class="bg-color dark">
        <div class="container clearfix">

            <div class="row justify-content-between">
                <div class="col-12 col-md-auto mr-md-auto">

                </div>


                <div class="col-12 col-md-auto pl-0">

                    <ul id="top-social">
                        <li><a href="{{config('general.social_links.facebook')}}" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                        <li><a href="{{config('general.social_links.twitter')}}" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                        <li><a href="{{config('general.social_links.instagram')}}" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                        <li><a href="{{config('general.phone')}}" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a></li>
                        <li><a href="{{config('general.email')}}" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">info@canvas.com</span></a></li>
                    </ul><!-- #top-social end -->

                </div>
            </div>

        </div>
    </div>

    <!-- Header
    ============================================= -->
    <header id="header" class="header-size-sm" data-sticky-shrink="false">
        <div class="container">
            <div class="header-row">

                <nav class="navbar navbar-expand-lg p-0 m-0 w-100">
                    <div id="logo">
                        <a href="{{route('website')}}" class="standard-logo"><img src="{{frontAssets('images/logo.png')}}" alt="Canvas Logo"></a>
                        <a href="{{route('website')}}" class="retina-logo"><img src="{{frontAssets('images/logo@2x.png')}}" alt="Canvas Logo"></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-line-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse align-items-end" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            @auth
                                @if(auth()->user()->role ==ADMIN or auth()->user()->role ==MANAGER)
                                    <li class="nav-item @if(activeUrl('dashboard')) active @endif">
                                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                                    </li>
                                @endif
                            @endauth
                            <li class="nav-item @if(activeUrl('website')) active @endif">
                                <a class="nav-link" href="{{route('website')}}">Home</a>
                            </li>

                            <li class="nav-item @if(activeUrl('courses')) active @endif">
                                <a href="{{route('courses')}}" class="nav-link">Courses</a>
                            </li>
                            <li class="nav-item @if(activeUrl('about')) active @endif">
                                <a href="{{route('about')}}" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item @if(activeUrl('contact')) active @endif">
                                <a href="{{route('contact')}}" class="nav-link">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>

        <div id="header-wrap" class="bg-light">
            <div class="container">
                <div class="header-row flex-row-reverse flex-lg-row justify-content-between">

                    <div class="header-misc">

                        <div class="header-buttons mr-3">
                            @guest
                                <a href="{{route('login')}}#tab-login" class="button button-rounded button-border button-small m-0">Log In</a>
                                <a href="{{route('register')}}#tab-register" class="button button-rounded button-small m-0 ml-2">Sign Up</a>
                            @endguest
                            @auth
                                    <a class="button button-rounded button-small m-0 ml-2" href="{{route('profile.show')}}">Profile</a>
                                    <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="button button-rounded button-small m-0 ml-2">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            @endauth
                        </div>

                        <!-- Top Search
                        ============================================= -->
                        <div id="top-search" class="header-misc-icon">
                            <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
                        </div><!-- #top-search end -->

                    </div>

                    <div id="primary-menu-trigger">
                        <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav class="primary-menu with-arrows">

                        <ul class="menu-container">
                            <li class="menu-item"><a class="menu-link pl-0" href="#"><div><i class="icon-line-grid"></i>All Categories</div></a>
                                <ul class="sub-menu-container">
                                  @foreach($categories as $category)
                                        <li class="menu-item"><a class="menu-link" href="{{route('search.by.category',$category->slug)}}"><div>{{$category->name}}</div></a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>

                    </nav><!-- #primary-menu end -->

                    <form class="top-search-form" action="{{route('search.by.keyword')}}" method="get">
                        <input type="text" name="search" class="form-control" value="{{old('search')}}" placeholder="Type &amp; Hit Enter.." autocomplete="off">
                    </form>

                </div>
            </div>
        </div>
        <div class="header-wrap-clone"></div>
    </header><!-- #header end -->

    @yield('slider')
    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap" style="overflow: visible;">

          @yield('content')

        </div>
    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <footer id="footer" class="dark">
        <!-- Copyrights
        ============================================= -->
        <div id="copyrights">

            <div class="container clearfix">

                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6">
                        Copyrights &copy; {{date('Y')}} All Rights Reserved by <a href="https://www.linkedin.com/in/hatem-mohamed-31b8901a2/">Hatem Mohamed.</a><br>
                    </div>

                    <div class="col-md-6 d-flex justify-content-md-end mt-4 mt-md-0">
                        <div class="copyrights-menu copyright-links mb-0 clearfix">
                            <a href="{{route('website')}}">Home</a>/<a href="{{route('about')}}">About Us</a>/<a href="{{route('courses')}}">Courses</a>/<a href="{{route('contact')}}">Contact</a>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- #copyrights end -->

    </footer><!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
<script src="{{frontAssets('js/jquery.js')}}"></script>
<script src="{{frontAssets('js/plugins.min.js')}}"></script>

<!-- Footer Scripts
============================================= -->
<script src="{{frontAssets('js/functions.js')}}"></script>

</body>
</html>
