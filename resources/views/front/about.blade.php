@extends('layouts.frontend-master')
@section('content')
    <div class="container clearfix">

        <div class="row col-mb-80 mb-0">

            <div class="col-12">

                <div class="heading-block center border-bottom-0">
                    <h2>Interactive Office Environment</h2>
                    <span>{{config('general.bio')}}</span>
                </div>

                <div class="fslider" data-pagi="false" data-animation="fade">
                    <div class="flexslider" style="height: 452.633px;">
                        <div class="slider-wrap">
                            <div class="slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><a href="#"><img src="{{frontAssets('images/4.jpg')}}" alt="About Image" draggable="false"></a></div>
                            <div class="slide flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"><a href="#"><img src="{{frontAssets('images/5.jpg')}}" alt="About Image" draggable="false"></a></div>
                            <div class="slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><a href="#"><img src="{{frontAssets('images/6.jpg')}}" alt="About Image" draggable="false"></a></div>
                            <div class="slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><a href="#"><img src="{{frontAssets('images/7.jpg')}}" alt="About Image" draggable="false"></a></div>
                        </div>
                        <ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="icon-angle-left"></i></a></li><li class="flex-nav-next"><a class="flex-next" href="#"><i class="icon-angle-right"></i></a></li></ul></div>
                </div>

            </div>

            <div class="col-lg-3 center not-animated" data-animate="bounceIn">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-users"></i>
                <div class="counter counter-large" style="color: #3498db;"><span data-from="0" data-to="{{$instructors}}" data-refresh-interval="50" data-speed="2000"></span></div>
                <h5>Instructors</h5>
            </div>

            <div class="col-lg-3 center not-animated" data-animate="bounceIn" data-delay="200">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-video"></i>
                <div class="counter counter-large" style="color: #e74c3c;"><span data-from="0" data-to="{{$courses}}" data-refresh-interval="50" data-speed="2500"></span></div>
                <h5>Courses</h5>
            </div>

            <div class="col-lg-3 center not-animated" data-animate="bounceIn" data-delay="400">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-cubes"></i>
                <div class="counter counter-large" style="color: #16a085;"><span data-from="0" data-to="{{$categories->count()}}" data-refresh-interval="50" data-speed="3500"></span></div>
                <h5>Categories</h5>
            </div>

            <div class="col-lg-3 center not-animated" data-animate="bounceIn" data-delay="600">
                <i class="i-plain i-xlarge mx-auto mb-0 icon-file-alt"></i>
                <div class="counter counter-large" style="color: #9b59b6;"><span data-from="0" data-to="{{$materials}}" data-refresh-interval="30" data-speed="2700"></span></div>
                <h5>Materials</h5>
            </div>

        </div>

    </div>
@endsection
