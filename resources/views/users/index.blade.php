@extends('adminlte::page')

@section('title', 'Users')

@section('boxtitle')
    Users
@stop
@section('boxtitleright')
    <a href="{{route('users.create')}}" class="btn btn-success">Create User</a>
@stop
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number">{{$users->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
	@section('boxcontent')
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<th style="width: 10px">ID</th>
    			<th>Name</th>
    			<th>Email</th>
                <th>Group(s)</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($users as $user)
    			<tr>
    				<td>{{$user->id}}</td>
    				<td>{{$user->name}}</td>
    				<td>{{$user->email}}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <label class="label label-default">{{$role->name}}</label>
                        @endforeach
                    </td>
    				<td>
    					<a href="{{route('users.edit', $user->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> Edit User</a>

                         
    				</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
	@endsection

	@section('boxfooter')
		{{$users->links()}}
	@endsection
	@include('layouts.box')
	</div>
</div>


@endsection
