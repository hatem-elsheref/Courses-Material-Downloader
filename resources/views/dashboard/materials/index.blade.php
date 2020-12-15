@extends('layouts.backend-master')
@section('bread')
    <h1>Course ({{$course->name}}) Material</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('course.index')}}"><i class="fa fa-dashboard"></i> Courses</a></li>
        <li class="active">Course ({{$course->name}}) Material</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">

            <div class="col-xs-12">
                <a href="{{route('material.create',$course->id)}}" class="btn  btn-primary d-block" style="margin-bottom: 5px"><span class="fa fa-plus"></span> Add New Material </a>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Course ({{$course->name}}) Material <span class="badge badge-success">{{$materials->count()}}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Part / Chapter</th>
                                <th>Type</th>
                                <th>Downloads</th>
                                <th>View Content</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($materials as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$course->name}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->year}}</td>
                                    <td>{{$item->part}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->download}}</td>
                                    @if($item->source == 'Uploading')
                                        <td><a class="btn btn-sm btn-info" href="{{uploadedAssets($item->path)}}" target="_blank"> <i class="fa fa-info"></i> View  </a></td>
                                        @elseif($item->source == 'External_Host')
                                        <td><a class="btn btn-sm btn-info" href="{{$item->path}}" target="_blank"> <i class="fa fa-info"></i> View  </a></td>
                                    @elseif($item->source == 'Youtube')
                                        <td><a class="btn btn-sm btn-info" href="{{$item->path}}" target="_blank"> <i class="fa fa-info"></i> View  </a></td>
                                    @else
                                    <td><a class="btn btn-sm btn-info" href="#" target="_blank"> <i class="fa fa-info"></i> View  </a></td>
                                    @endif
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$item->id}}')"> <i class="fa fa-trash"></i>   Remove </button>
                                        <a href="{{route('material.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>  Edit </a>
                                    </td>
                                    <form action="{{route('material.destroy',$item->id)}}" id="item-{{$item->id}}" method="POST"> @csrf @method('DELETE') </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $materials->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
