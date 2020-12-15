@extends('layouts.backend-master')
@section('bread')
    <h1>Edit Instructor</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('instructor.index')}}"><i class="fa fa-user-secret"></i> Instructors</a></li>
        <li class="active">Edit Instructor</li>
    </ol>
@endsection

@section('content')
    <section >
        <div class="row">
            <!-- Form column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Instructor</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('instructor.update',$instructor->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder=" Enter The Instructor Name" value="{{$instructor->name}}" >
                                                @error('name')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input  type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder=" Enter The Instructor Email" value="{{$instructor->email}}" >
                                                @error('email')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="job">Job Title</label>
                                                <input  type="text" class="form-control @error('job') is-invalid @enderror" name="job" placeholder=" Enter The Job" value="{{$instructor->job}}" >
                                                @error('job')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="custom-file mb-3">
                                                <label for="photo">Photo</label>
                                                <input type="file" name="photo" class="custom-file-input" id="photo">
                                                @error('photo')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                                <img src="{{uploadedAssets($instructor->photo)}}" onclick="document.getElementById('photo').click()" style="width: 75px;height: 75px;margin-top: 10px" id="tmp_image" alt="temporary image">
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
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tmp_image').attr('src', e.target.result);
                    // $('#ok').removeClass('mdi-reload mdi-spin');
                    // $('#label').attr('hidden',false);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#photo").change(function() {
            readURL(this);
        });
    </script>
@endsection
