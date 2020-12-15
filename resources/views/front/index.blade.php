@extends('layouts.frontend-master')
@section('slider')

    <!-- Slider
    ============================================= -->
    <section id="slider" class="slider-element min-vh-75">
        <div class="slider-inner">

            <div class="vertical-middle">
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="slider-title mb-5 dark clearfix">
                                <h2 class="text-white text-rotater mb-2" data-separator="," data-rotate="fadeIn" data-speed="3500">Learn More About <span class="t-rotate text-white">Development,Photography,Teacher Training,Business,Lifestyle,Language,Health,Fitness,Music</span>.</h2>
                                <p class="lead mb-0 text-uppercase ls2" style="color: #CCC; font-size: 110%">What Do You Want To Learn?</p>
                            </div>
                            <div class="clear"></div>
                            <form action="{{route('search.by.keyword')}}">
                                <div class="input-group input-group-lg mt-1">

                                    <input class="form-control rounded border-0" name="search" type="search" placeholder="Search Your Courses.." aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="icon-line-search font-weight-bold"></i></button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HTML5 Video Wrap
            ============================================= -->
            <div class="video-wrap">
                <video id="slide-video" poster="{{frontAssets('images/video/poster.jpg')}}" preload="auto" loop autoplay muted>
                    <source src='{{frontAssets('images/video/1.mp4')}}' type='video/mp4' />
                </video>
                <div class="video-overlay" style="background: rgba(0,0,0,0.5); z-index: 1"></div>
            </div>

        </div>
    </section>

@endsection
@section('content')
    <!-- Wave Shape Divider
            ============================================= -->
    <div class="wave-bottom" style="position: absolute; top: -12px; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);"></div>

    <div class="container">

        <div class="heading-block border-bottom-0 my-4 center">
            <h3>Popular Categories</h3>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum. Voluptatibus, perspiciatis placeat.</span>
        </div>

        <!-- Categories
        ============================================= -->
        <div class="row course-categories clearfix mb-4">
            @foreach($categories as $category)
                <div class="col-lg-2 col-sm-3 col-6 mt-4">
                    <div class="card hover-effect">
                        @php
                            $info=getImage();
                        @endphp
                        <img class="card-img" src="{{frontAssets($info[0])}}" alt="Card image">
                        <a href="{{route('search.by.category',$category->slug)}}" class="card-img-overlay rounded p-0" style="background-color: rgba({{rand(0,255)}},{{rand(0,255)}},{{rand(0,255)}},0.8);">
                            <span><i class="{{$info[1]}}"></i>{{ucfirst($category->name)}}</span>
                        </a>
                    </div>
                </div>
            @endforeach


        </div>

        <div class="clear"></div>

    </div>

    <!-- Section Courses
    ============================================= -->
    <div class="section topmargin-lg parallax" style="padding: 80px 0 60px; background-image: url('{{frontAssets('images/icon-pattern.jpg')}}'); background-size: auto; background-repeat: repeat"  data-bottom-top="background-position:0px 100px;" data-top-bottom="background-position:0px -500px;">

        <!-- Wave Shape Divider
        ============================================= -->
        <div class="wave-top" style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x;"></div>

        <div class="container">

            <div class="heading-block border-bottom-0 mb-5 center">
                <h3>Popular Courses</h3>
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum. Voluptatibus, perspiciatis placeat.</span>
            </div>

            <div class="clear"></div>

            <div class="row mt-2">

                @foreach($topCourses as $topCourse)
                    <!--============================================= -->
                    <div class="col-md-4 mb-5">
                        <div class="card course-card hover-effect border-0">
                            <a href="{{route('courses.details',$topCourse->slug)}}"><img class="card-img-top" style="width: 410px;height: 273px" src="{{uploadedAssets($topCourse->photo)}}" alt="Card image cap"></a>
                            <div class="card-body">
                                <h4 class="card-title font-weight-bold mb-2"><a href="{{route('courses.details',$topCourse->slug)}}">{{\Illuminate\Support\Str::limit($topCourse->name,4,'...')}}</a></h4>
                                <p class="mb-2 card-title-sub text-uppercase font-weight-normal ls1"><a href="{{route('search.by.category',$topCourse->category->slug)}}" class="text-black-50">{{$topCourse->category->name}}</a></p>
                                <p class="card-text text-black-50 mb-1">{!! \Illuminate\Support\Str::limit($topCourse->description,15,'...') !!}</p>
                            </div>
                            <div class="card-footer py-3 d-flex justify-content-between align-items-center bg-white text-muted">
                                @if($topCourse->price == 0)
                                    <div class="badge alert-warning">Free</div>
                                @else
                                    <div class="badge alert-primary">${{$topCourse->price}}</div>
                                @endif
                                <a href="{{route('search.by.instructor',$topCourse->instructor->id)}}" class="text-dark position-relative"><i class="icon-line2-user"></i> <span>{{ucwords($topCourse->instructor->name)}}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================= -->
                @endforeach


            </div>
        </div>

        <!-- Wave Shape Divider - Bottom
        ============================================= -->
        <div class="wave-bottom" style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);"></div>
    </div>











    <!-- Instructors Section
    ============================================= -->
    <div class="section bg-transparent" style="padding: 60px 0 40px;">
        <div class="container">

            <div class="heading-block border-bottom-0 mb-5 center">
                <h3>Most Popular Instructors</h3>
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum. Voluptatibus, perspiciatis placeat.</span>
            </div>

            <div class="clear"></div>

            <div class="row">
                @foreach($instructors as $instructor)

                    <!--============================================= -->
                        <div class="col-lg-3 col-sm-6 mb-4">
                            <div class="feature-box hover-effect shadow-sm fbox-center fbox-bg fbox-light fbox-lg fbox-effect">
                                <div class="fbox-icon">
                                    <i><img src="{{uploadedAssets($instructor->photo)}}" class="border-0 bg-transparent shadow-sm" style="z-index: 2;" alt="Image"></i>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="mb-4 nott ls0"><a href="{{route('search.by.instructor',$instructor->id)}}" class="text-dark">{{$instructor->name}}</a><br><small class="subtitle nott color">{{ucwords($instructor->title)}}</small></h3>
                                    <p class="text-dark mt-0"><strong>{{$instructor->courses->count()}}</strong> Courses</p>
                                </div>
                            </div>
                        </div>
                        <!--============================================= -->
                    @endforeach
            </div>
        </div>
    </div>

    <!-- Featues Section
    ============================================= -->
    <div class="section mt-5 mb-0" style="padding: 120px 0; background-image: url('{{frontAssets('images/icon-pattern-bg.jpg')}}'); background-size: auto; background-repeat: repeat">

        <!-- Wave Shape
        ============================================= -->
        <div class="wave-top" style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x;"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row dark clearfix">

                        <!-- Feature - 1
                        ============================================= -->
                        <div class="col-md-6">
                            <div class="feature-box media-box bottommargin">
                                <div class="fbox-icon">
                                    <a href="#">
                                        <i class="icon-line2-book-open rounded-0 bg-transparent text-left"></i>
                                    </a>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="text-white">21,000 Online Courses</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi rem, facilis nobis voluptatum est voluptatem accusamus molestiae eaque perspiciatis mollitia.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature - 2
                        ============================================= -->
                        <div class="col-md-6">
                            <div class="feature-box media-box bottommargin">
                                <div class="fbox-icon">
                                    <a href="#">
                                        <i class="icon-line2-note rounded-0 bg-transparent text-left"></i>
                                    </a>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="text-white">Lifetime Access</h3>
                                    <p class="text-white">Porro repellat vero sapiente amet vitae quibusdam necessitatibus consectetur, labore totam. Accusamus perspiciatis asperiores labore esse.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature - 3
                        ============================================= -->
                        <div class="col-md-6">
                            <div class="feature-box media-box bottommargin">
                                <div class="fbox-icon">
                                    <a href="#">
                                        <i class="icon-line2-user rounded-0 bg-transparent text-left"></i>
                                    </a>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="text-white">Expert Instructors</h3>
                                    <p class="text-white">Quos, non, esse eligendi ab accusantium voluptatem. Maxime eligendi beatae, atque tempora ullam. Vitae delectus quia, consequuntur rerum quo.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature - 4
                        ============================================= -->
                        <div class="col-md-6">
                            <div class="feature-box media-box bottommargin">
                                <div class="fbox-icon">
                                    <a href="#">
                                        <i class="icon-line2-globe rounded-0 bg-transparent text-left"></i>
                                    </a>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="text-white">Different Languages</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi rem, facilis nobis voluptatum est voluptatem accusamus molestiae eaque perspiciatis mollitia.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Shape
        ============================================= -->
        <div class="wave-bottom" style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);"></div>

    </div>

    <!-- Promo Section
    ============================================= -->
    <div class="section m-0" style="padding: 120px 0; background: #FFF url('{{frontAssets('images/instructor.jpg')}}') no-repeat left top / cover">
        <div class="container">
            <div class="row">

                <div class="col-md-7"></div>

                <div class="col-md-5">
                    <div class="heading-block border-bottom-0  mt-5">
                        <h3>Become an Instructor!</h3>
                        <span>Teach What You Love.</span>
                    </div>
                    <p class="mb-2">Monotonectally conceptualize covalent strategic theme areas and cross-unit deliverables.</p>
                    <p>Consectetur adipisicing elit. Voluptate incidunt dolorum perferendis accusamus nesciunt et est consequuntur placeat, dolor quia.</p>
                    <a href="#" class="button button-rounded button-xlarge ls0 ls0 nott font-weight-normal m-0">Start Teaching</a>
                </div>

            </div>
        </div>
    </div>


@endsection
