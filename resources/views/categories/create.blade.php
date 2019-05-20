@extends('adminlte::page')

@section('title', 'Create Category')

@section('boxtitle')
    Create Category
@stop
@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		@section('boxcontent')
		    
		   
<form method="post" action="{{ route('categories.store') }}">

        @csrf
		    	
		    	
				<div class="form-group text-left">
					<label>Name:</label>
	                {!! Form::text('name', null,['class' => 'form-control', 'rows'=>'4']) !!}
				</div>

				<div class="form-group text-left">
					<label>Prefix:</label>
	                {!! Form::text('prefix', null,['class' => 'form-control', 'rows'=>'4']) !!}
				</div>


				<a href="{{route('categories.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>
				<button class="btn btn-primary " type="submit"><span class="glyphicon glyphicon-ok"></span> Create</button>
	    {!! Form::close()!!}

		@endsection

		@section('boxfooter')

		@endsection
		@include('layouts.box')
	</div>
</div>
@endsection