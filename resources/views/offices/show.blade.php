@extends('adminlte::page')

@section('title', 'Office - '.$office->name)

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
          <span class="info-box-icon bg-default"><i class="fa fa-home"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">{{$office->url}}</span>
            <span class="info-box-number">{{$office->name}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number">{{count($results)}}</span>
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
                <th>Balance(s)</th>
    			<th>Action</th>
                <td>Trades</td>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($results as $user)
    			<tr>
    				<td>{{$user->id}}</td>
    				<td>{{$user->firstname.' '.$user->lastname}}</td>
    				<td>{{$user->email}}</td>
                    <td>{{$user->eur}}</td>
    				<td>
    					<a href="{{route('users.edit', $user->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> Edit User</a>
                    </td>
                    <td><a href="#" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> {{count($user->trades)}} Trades</a>
               </td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
	@endsection

	
	@include('layouts.box')
	</div>
</div>


@endsection
