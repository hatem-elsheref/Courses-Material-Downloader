@extends('layouts.backend-master')
@section('bread')
    <h1>{{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Courses</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">

            <div class="col-xs-12">
                <a href="{{route('course.create')}}" class="btn  btn-primary d-block" style="margin-bottom: 5px"><span class="fa fa-plus"></span> Add New Course </a>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$title}} <span class="badge badge-success">{{$courses->count()}}</span></h3>
                        <div class="box-tools">
                            <form action="{{route('course.index')}}" method="get">
                                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                    <input type="text" name="search" value="{{request()->query('search')}}" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Instructor</th>
                                <th>Price</th>
                                <th>Materials</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($courses as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{uploadedAssets($item->photo)}}" style="width: 45px;height: 45px"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->instructor->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->materials->count()}}</td>
                                    <td><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-description-{{$item->id}}"> <i class="fa fa-info"></i> View Descriptions </button></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$item->id}}')"> <i class="fa fa-trash"></i>   Remove </button>
                                        <a href="{{route('course.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>  Edit </a>
                                        <a href="{{route('course.show',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eys"></i>  View Materials </a>
                                    </td>
                                    <form action="{{route('course.destroy',$item->id)}}" id="item-{{$item->id}}" method="POST"> @csrf @method('DELETE') </form>
                                    <div class="modal fade" id="modal-description-{{$item->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Description</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <ul class="list-group list-group-flush">
                                                                {!! $item->description !!}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $courses->appends(request()->query())->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
