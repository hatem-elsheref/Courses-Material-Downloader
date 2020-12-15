@extends('layouts.frontend-master')
@section('content')
    <div class="container clearfix">

        <div class="row align-items-stretch col-mb-50 mb-0">
            <!-- Contact Form
            ============================================= -->
            <div class="col-lg-12">
                @if(session()->has('response'))
                    <div class="alert alert-{{session('response')['type']}}">{{session('response')['message']}}</div>
                @endif
                <div class="fancy-title title-border">
                    <h3>Send us an Email</h3>
                </div>

                <div class="form-widget">
                    <form    action="{{route('contact.send')}}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="template-name">Name <small>*</small></label>
                                <input type="text" id="template-name" name="name" value="{{old('name')}}" class="sm-form-control ">
                                @error('name')
                                <span class="text-danger">*{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="template-email">Email <small>*</small></label>
                                <input type="email" id="template-email" name="email" value="{{old('email')}}" class="sm-form-control">
                               @error('email')
                                <span class="text-danger">*{{$message}}</span>
                                @enderror
                            </div>


                            <div class="w-100"></div>

                            <div class="col-md-12 form-group">
                                <label for="template-subject">Subject <small>*</small></label>
                                <input type="text" id="template-subject" name="subject" value="{{old('subject')}}" class="sm-form-control">
                                @error('subject')
                                <span class="text-danger">*{{$message}}</span>
                                @enderror
                            </div>

                            <div class="w-100"></div>

                            <div class="col-12 form-group">
                                <label for="template-message">Message <small>*</small></label>
                                <textarea class="sm-form-control" id="template-message" name="message" rows="6" cols="30">{{old('message')}}</textarea>
                                @error('message')
                                <span class="text-danger">*{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <input  type="submit"  class="button button-3d m-0" value="Send Message">
                            </div>
                        </div>

                    </form>
                </div>

            </div><!-- Contact Form End -->
        </div>

        <!-- Contact Info
        ============================================= -->
        <div class="row col-mb-50">
            <div class="col-sm-6 col-lg-6">
                <div class="feature-box fbox-center fbox-bg fbox-plain">
                    <div class="fbox-icon">
                        <a href="#"><i class="icon-map-marker2"></i></a>
                    </div>
                    <div class="fbox-content">
                        <h3>Our Address<span class="subtitle">{{ucwords(config('general.address'))}}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-6">
                <div class="feature-box fbox-center fbox-bg fbox-plain">
                    <div class="fbox-icon">
                        <a href="#"><i class="icon-phone3"></i></a>
                    </div>
                    <div class="fbox-content">
                        <h3>Speak to Us<span class="subtitle">{{config('general.phone')}}</span></h3>
                    </div>
                </div>
            </div>

        </div><!-- Contact Info End -->

    </div>
@endsection
