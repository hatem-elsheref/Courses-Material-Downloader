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

    </header><!-- #header end -->

    <section id="content">
        <div class="content-wrap" style="padding-top: 15px">
            <div class="container clearfix">
                @if(session()->has('response'))
                    <div class="alert alert-{{session('response')['type']}}">{{session('response')['message']}}</div>
                @endif
                <div class="tabs mx-auto mb-0 clearfix" id="tab-login-register" style="max-width: 500px;">

                    <ul class="tab-nav tab-nav2 center clearfix">
                        <li class="inline-block"><a href="#tab-profile">Profile</a></li>
                    </ul>

                    <div class="tab-container">


                        <div class="tab-content" id="tab-profile">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <h3>Account Information</h3>

                                    <form id="register-form" name="register-form" class="row mb-0" action="{{route('profile.update')}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-12 form-group">
                                            <label for="register-form-name">Name:</label>
                                            <input type="text" id="register-form-name" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" required  />
                                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-email">Email Address:</label>
                                            <input type="text" id="register-form-email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" required />
                                            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-opassword">Old Password:</label>
                                            <input type="password" id="register-form-opassword" name="old_password" value="" class="form-control  @error('old_password') is-invalid @enderror"  autocomplete="new-password" />
                                            @error('old_password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>


                                        <div class="col-12 form-group">
                                            <label for="register-form-password">Choose Password:</label>
                                            <input type="password" id="register-form-password" name="password" value="" class="form-control  @error('password') is-invalid @enderror"  autocomplete="new-password" />
                                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-repassword">Re-enter Password:</label>
                                            <input type="password" id="register-form-repassword" name="password_confirmation"  autocomplete="new-password" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <button class="button button-3d button-black m-0" id="register-form-submit" name="register-form-submit" value="update">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
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
