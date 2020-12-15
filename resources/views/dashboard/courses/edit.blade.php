@extends('layouts.backend-master')
@section('bread')
    <h1>Edit Course</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('course.index')}}"><i class="fa fa-graduation-cap"></i> Courses</a></li>
        <li class="active">Edit Course</li>
    </ol>
@endsection
@section('css_before')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{adminAssets('css/bootstrap3-wysihtml5.min.css')}}">
@endsection
@section('js')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{adminAssets('js/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5({toolbar: {
                    "font-styles": true, // Font styling, e.g. h1, h2, etc.
                    "emphasis": true, // Italics, bold, etc.
                    "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
                    "html": false, // Button which allows you to edit the generated HTML.
                    "link": false, // Button to insert a link.
                    "image": false, // Button to insert an image.
                    "color": false, // Button to change color of font
                    "blockquote": true, // Blockquote
                }});
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {$('#tmp_image').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#photo").change(function() {readURL(this);});
    </script>
@endsection

@section('content')
    <section >
        <div class="row">
            <!-- Form column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Course</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('course.update',$course->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder=" Enter The Course Name" value="{{$course->name}}" >
                                                @error('name')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <div class="col-sm-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="price">Price</label>--}}
{{--                                                <input type="number" min="0"  class="form-control   @error('price') is-invalid @enderror " name="price" placeholder=" Enter The Course Price" value="{{$course->price}}">--}}
{{--                                                @error('price')--}}
{{--                                                <div class="invalid-feedback text-danger">{{$message}}</div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category_id" class="form-control custom-select" required>
                                                    <option disabled selected>__select the category__</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{($course->category_id == $category->id)?'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="instructor">Instructor</label>
                                                <select name="instructor_id" class="form-control custom-select" required>
                                                    <option disabled selected>__select the instructor__</option>
                                                    @foreach($instructors as $instructor)
                                                        <option value="{{$instructor->id}}" {{($course->instructor_id == $instructor->id)?'selected':''}}>{{$instructor->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('instructor_id')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>Description</label>
                                            @error('description')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                            @enderror
                                            <textarea class="textarea" name="description" placeholder="Place enter the course description here"
                                                      style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                {!! $course->description !!}
                                            </textarea>

                                        </div>
                                        <div class="col-sm-12">
                                            <div class="custom-file mb-3">
                                                <label for="photo">Photo</label>
                                                <input type="file"  name="photo" class="custom-file-input" id="photo">
                                                @error('photo')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                                <img src="{{uploadedAssets($course->photo)}}" onclick="document.getElementById('photo').click()" style="width: 75px;height: 75px;margin-top: 10px" id="tmp_image" alt="temporary image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Save</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (Form) -->
        </div>   <!-- /.row -->
    </section>
@endsection
