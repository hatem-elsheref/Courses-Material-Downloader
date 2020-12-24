@extends('layouts.frontend-master')
@section('css')
    <style>
        .content-wrap{
            padding: 20px 0px;
        }
    </style>
@endsection

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


    <!-- Section Courses
    ============================================= -->
    <div class="  parallax" style="padding: 80px 0 60px; background-image: url('{{frontAssets('images/icon-pattern.jpg')}}'); background-size: auto; background-repeat: repeat"  data-bottom-top="background-position:0px 100px;" data-top-bottom="background-position:0px -500px;">
        <!-- Wave Shape Divider
        ============================================= -->
        <div class="wave-top" style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x;"></div>

        <div class="container">

            <div class="heading-block border-bottom-0 mb-5 center">
                <h3>Most Popular Courses</h3>
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum. Voluptatibus, perspiciatis placeat.</span>
            </div>

            <div class="clear"></div>

            <div class="row mt-2">

            @forelse($courses as $topCourse)
                <!--============================================= -->
                    <div class="col-md-4 mb-5">
                        <div class="card course-card hover-effect border-0">
                            <a href="{{route('courses.details',$topCourse->slug)}}"><img class="card-img-top" style="width: 410px;height: 273px" src="{{uploadedAssets($topCourse->photo)}}" alt="Card image cap"></a>
                            <div class="card-body">
                                <h4 class="card-title font-weight-bold mb-2"><a href="{{route('courses.details',$topCourse->slug)}}">{{$topCourse->name}}</a></h4>
                                <p class="mb-2 card-title-sub text-uppercase font-weight-normal ls1"><a href="{{route('search.by.category',$topCourse->category->slug)}}" class="text-black-50">{{$topCourse->category->name}}</a></p>
                                <p class="card-text text-black-50 mb-1">{!! \Illuminate\Support\Str::limit($topCourse->description,40,'...') !!}</p>
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
                @empty
                NO Courses Founded !!
                @endforelse

            </div>

            <div class="heading-block border-bottom-0 mb-5 center">
                {!! $courses->appends(['search'=>request()->search])->render() !!}
            </div>
        </div>

        <!-- Wave Shape Divider - Bottom
        ============================================= -->
        <div class="wave-bottom" style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('{{frontAssets('images/wave-3.svg')}}'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);"></div>
    </div>











@endsection
