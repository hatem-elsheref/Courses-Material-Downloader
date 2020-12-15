@extends('layouts.backend-master')
@section('bread')
    <h1>Add New  Material</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('course.show',$course->id)}}"><i class="fa fa-graduation-cap"></i> Courses Materials</a></li>
        <li class="active">Add New Material</li>
    </ol>
@endsection
@section('content')
    <section >
        <div class="row">
            <!-- Form column -->
            <div class="col-md-12">
                @error('file')
                <div class="alert alert-danger">{{$message}}</div>
               @enderror
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Material</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('material.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder=" Enter The Material title" value="{{old('title')}}" >
                                @error('title')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="year">Year</label>
                                <select name="year" class="form-control custom-select" required>
                                    <option disabled selected>__select the year__</option>
                                    @foreach(range(1995,date('Y')) as $year)
                                        <option value="{{$year}}" {{(old('year') == $year)?'selected':''}}>{{$year}}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="part">Part / Chapter</label>
                                <select name="part" class="form-control custom-select" required>
                                    <option disabled selected>__select the part__</option>
                                    @foreach(range(1,100) as $part)
                                        <option value="{{$part}}" {{(old('part') == $part)?'selected':''}}>{{$part}}</option>
                                    @endforeach
                                </select>
                                @error('part')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" class="form-control custom-select" id="material_type" required>
                                    <option disabled selected>__select the type__</option>
                                    @foreach($types as $type)
                                        <option value="{{$type}}" {{(old('type') == $type)?'selected':''}}>{{ucfirst($type)}}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <select name="source" class="form-control custom-select" id="source" required>
                                    <option disabled selected>__select the source__</option>
                                    @foreach($sources as $source)
                                        <option value="{{$source}}" {{(old('source') == $source)?'selected':''}}>{{$source}}</option>
                                    @endforeach
                                </select>
                                @error('source')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-2" id="for-upload">
                                <div class="custom-file mb-3">
                                    <label for="material_upload">Images / Files</label>
                                    <input type="file"  name="material_upload" class="custom-file-input" id="material_upload">
                                    @error('material_upload')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <span class="fa fa-check text-success fa-2x" style="display: none" id="uploaded_check"> Done</span>
                                    <img src="{{asset(DEFAULT_TEMPORARY)}}" onclick="document.getElementById('material_upload').click()" style="width: 75px;height: 75px;margin-top: 10px" id="tmp_image" alt="temporary image">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label for="material_external_host">Link (External Host)</label>
                                <input  type="text" class="form-control @error('material_external_host') is-invalid @enderror" name="material_external_host" placeholder=" Enter The Link Name" value="{{old('material_external_host')}}" >
                                @error('material_external_host')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-5" id="for-youtube">
                                <label for="material_youtube">Video Link (Youtube)</label>
                                <input  type="text" class="form-control @error('material_youtube') is-invalid @enderror" name="material_youtube" placeholder=" Enter The Youtube Video Id" value="{{old('material_youtube')}}" >
                                @error('material_youtube')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
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
    $(document).ready(function (){
        $('#material_type').on('change',function (){
            let MaterialType=$(this).val();
            let UploadForm=$('#for-upload');
            let YoutubeForm=$('#for-youtube');
            UploadForm.attr('hidden',false)
            YoutubeForm.attr('hidden',false)
            if (MaterialType === 'video' || MaterialType === 'audio'){
                UploadForm.attr('hidden',true);
                if (MaterialType === 'video')
                    YoutubeForm.attr('hidden',false);else YoutubeForm.attr('hidden',true);
            }else
                YoutubeForm.attr('hidden',true);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tmp_image').remove();
                $('#uploaded_check').css('display','unset');
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#material_upload").change(function() {
        readURL(this);
    });
</script>
@endsection
