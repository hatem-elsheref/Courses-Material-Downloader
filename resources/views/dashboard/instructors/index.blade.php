@extends('layouts.backend-master')
@section('bread')
    <h1>All Instructors</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Instructors</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">

            <div class="col-xs-12">
                <a href="{{route('instructor.create')}}" class="btn  btn-primary d-block" style="margin-bottom: 5px"><span class="fa fa-plus"></span> Add New Instructor </a>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Instructors <span class="badge badge-success">{{$instructors->count()}}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Job</th>
                                <th>Courses</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($instructors as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{uploadedAssets($item->photo)}}" style="width: 45px;height: 45px"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->job}}</td>
                                    <td>{{$item->courses->count()}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$item->id}}')"> <i class="fa fa-trash"></i>   Remove </button>
                                        <a href="{{route('instructor.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>  Edit </a>
                                        <a href="{{route('instructor.show',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eys"></i>  View Courses </a>
                                    </td>
                                    <form action="{{route('instructor.destroy',$item->id)}}" id="item-{{$item->id}}" method="POST"> @csrf @method('DELETE') </form>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
