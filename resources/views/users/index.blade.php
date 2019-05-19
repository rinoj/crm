@extends('adminlte::page')

@section('title', 'Users')

@section('boxtitle')
    Users
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
    			<th>ID</th>
    			<th>Name</th>
    			<th>Email</th>
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
    					<a href="{{route('users.edit', $user->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit User</a>
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