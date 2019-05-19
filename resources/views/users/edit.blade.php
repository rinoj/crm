@extends('adminlte::page')

@section('title', $user->name)

@section('boxtitle')
    Edit User
@stop
@section('content')

<div class="row">
	<div class="col-md-6">
		@section('boxcontent')
		    
		   
<form method="post" action="{{ route('users.update', $user->id) }}">

 @method('PATCH')
        @csrf
		    	
		    	<div class="form-group text-left">
					<label>ID:</label>
	                {!! Form::text('id', $user->id,['class' => 'form-control', 'rows'=>'4', 'disabled']) !!}
				</div>

				<div class="form-group text-left">
					<label>Name:</label>
	                {!! Form::text('name', $user->name,['class' => 'form-control', 'rows'=>'4']) !!}
				</div>

				<div class="form-group text-left">
					<label>Email:</label>
	                {!! Form::text('email', $user->email,['class' => 'form-control', 'rows'=>'4']) !!}
				</div>

				<a href="{{route('users.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>
				<button class="btn btn-primary " type="submit"><span class="glyphicon glyphicon-ok"></span> Edit</button>
	    {!! Form::close()!!}

		@endsection

		@section('boxfooter')

		@endsection
		@include('layouts.box')
	</div>
</div>
@endsection