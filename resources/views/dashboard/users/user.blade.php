@extends('layouts.backend-master')
@section('bread')
    <h1>All {{$type}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{ucfirst($type)}}</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ucfirst($type)}} <span class="badge badge-success">{{$users->count()}}</span></h3>
                        <div class="box-tools">
                            <form action="{{route(($type == MANAGER)?'admins':'users')}}" method="get">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ucfirst($user->role)}}</td>
                                    <td>
                                        @if($user->role ==ADMIN)
                                            <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-block-{{$user->id}}','Do You Sure To Make This Admin A Normal User ?')">  Mark As Normal User  </button>
                                        @else
                                            <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-block-{{$user->id}}','Do You Sure To Make This User A Admin ?')"> Mark As Admin </button>
                                        @endif
                                    </td>
                                    <form action="{{route('users.role',$user->id)}}" id="item-block-{{$user->id}}" method="POST">@csrf @method('PUT')
                                        <input type="hidden" name="id" value="{{$user->id}}"></form>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $users->appends(request()->query())->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
