@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop
@section('content')

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