@extends('layouts.frontend-master')
@section('content')
    <div class="container clearfix">

        <div class="single-product">
            <div class="product">
                <div class="row gutter-40">
                    <div class="col-md-6">

                        <!-- course Single - Gallery
                        ============================================= -->
                        <div class="product-image">
                            <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                <div class="flexslider">
                                    <div class="slider-wrap" data-lightbox="gallery">
                                        <div class="slide" data-thumb="{{uploadedAssets($course->photo)}}"><a href="{{uploadedAssets($course->photo)}}" title="Pink Printed Dress - Front View" data-lightbox="gallery-item"><img src="{{uploadedAssets($course->photo)}}" alt="Pink Printed Dress"></a></div>
{{--                                        <div class="slide" data-thumb="{{frontAssets('images/shop/thumbs/dress/3-1.jpg')}}"><a href="{{frontAssets('images/shop/dress/3-1.jpg')}}" title="Pink Printed Dress - Side View" data-lightbox="gallery-item"><img src="{{frontAssets('images/shop/dress/3-1.jpg')}}" alt="Pink Printed Dress"></a></div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="sale-flash badge badge-danger p-2">{{$course->created_at->format('Y-m-d')}}</div>
                        </div><!-- course Single - Gallery End -->
                    </div>
                    <div class="col-md-6 product-desc">

                        <div class="d-flex align-items-center justify-content-between">

                            <!-- Product Single - Price
                            ============================================= -->
                            <div class="product-price"><ins>{{$course->price>0?'$'.$course->price:'Free'}}</ins></div><!-- Product Single - Price End -->
                        </div>

                        <div class="line"></div>


                        <!-- course Single - Short Description
                        ============================================= -->
                        <p>{!! $course->description !!}</p>

                        <!-- course Single - Meta
                        ============================================= -->
                        <div class="card product-meta">
                            <div class="card-body">
                                <span itemprop="productID" class="sku_wrapper">ID: <span class="sku">{{$course->id}}</span></span>
                                <span class="posted_in">Category: <a href="{{route('search.by.category',$course->category->slug)}}" rel="tag">{{ucwords($course->category->name)}}</a>.</span>
                                <span class="posted_in">Instructor: <a href="{{route('search.by.instructor',$course->instructor->id)}}" rel="tag">{{ucwords($course->instructor->job.' '.$course->instructor->name)}}</a>.</span>
                                <span class="tagged_as">Maerialst: {{$course->materials->count()}}</span>
                            </div>
                        </div>
                    </div>


                    <div class="w-100"></div>

                   @auth
                        <div class="col-12 mt-5">

                            <div class="tabs clearfix mb-0 ui-tabs ui-corner-all ui-widget ui-widget-content" id="tab-1">

                                <ul class="tab-nav clearfix ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" role="tablist">
                                    <li role="tab" tabindex="0" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#tabs-1" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-1"><i class="icon-video"></i><span class="d-none d-md-inline-block"> Videos</span></a></li>
                                    <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="#tabs-2" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-2"><i class="icon-image"></i><span class="d-none d-md-inline-block"> Images</span></a></li>
                                    <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="#tabs-3" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-3"><i class="icon-files"></i><span class="d-none d-md-inline-block"> Files </span></a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tabs-1" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" style="">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr><td>Video/Audio</td><td>Title</td><td>Downloads</td><td>Download</td></tr>
                                            @foreach($course->materials->whereIn('type',['video','audio']) as $file)
                                                <tr>
                                                    <td>{{$file->type}}</td>
                                                    <td>{{$file->download_name}}</td>
                                                    <td>{{$file->download}}</td>
                                                    <td><a href="{{route('download',$file->id)}}" class="btn btn-warning">Download</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tabs-2" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;" aria-hidden="true">

                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr><td>Image</td><td>Title</td><td>Downloads</td><td>Download</td></tr>
                                            @foreach($course->materials->where('type','image') as $image)
                                                <tr>
                                                    @if($image->source =='Uploading')
                                                        <td><img src="{{uploadedAssets($image->path)}}" class="img-thumbnail" style="width: 50px;height: 50px" title="{{$image->download_name}}"></td>
                                                    @else
                                                        <td><img src="{{$image->path}}" class="img-thumbnail" style="width: 50px;height: 50px" title="{{$image->download_name}}"></td>
                                                    @endif
                                                    <td>{{$image->download_name}}</td>
                                                    <td>{{$image->download}}</td>
                                                    <td><a href="{{route('download',$image->id)}}" class="btn btn-warning">Download</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tabs-3" aria-labelledby="ui-id-3" role="tabpanel" style="display: none;" aria-hidden="true">

                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr><td>Type</td><td>Title</td><td>Downloads</td><td>Download</td></tr>
                                            @foreach($course->materials->whereNotIn('type',['image','video']) as $file)
                                                <tr>
                                                    <td>{{$file->type}}</td>
                                                    <td>{{$file->download_name}}</td>
                                                    <td>{{$file->download}}</td>
                                                    <td><a href="{{route('download',$file->id)}}" class="btn btn-warning">Download</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endauth
                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="w-100">

            <h4>Related Courses</h4>

            <div class="owl-carousel product-carousel carousel-widget owl-loaded owl-drag" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-330px, 0px, 0px); transition: all 0.25s ease 0s; width: 1650px;">
                    @foreach($related as $item)
                            <div class="owl-item" style="width: 300px; margin-right: 30px;">
                                <div class="oc-item">
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="#"><img src="{{uploadedAssets($item->photo)}}" alt="{{$item->name}}"></a>
                                            <div class="badge badge-success p-2">
                                                {{$course->price>0?'$'.$course->price:'Free'}}
                                            </div>
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content align-items-end justify-content-between not-animated" data-hover-animate="fadeIn" data-hover-speed="400" style="animation-duration: 400ms;">
                                                </div>
                                                <div class="bg-overlay-bg bg-transparent"></div>
                                            </div>
                                        </div>
                                        <div class="product-desc center">
                                            <div class="product-title"><h3><a href="#">{{ucwords($course->name)}}</a></h3></div>
                                            <div class="product-price">{{ucwords($item->category->name)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next disabled"><i class="icon-angle-right"></i></button></div><div class="owl-dots disabled"></div></div>

        </div>

    </div>
@endsection
