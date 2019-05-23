@extends('adminlte::page')

@section('title', $category->name)

@section('boxtitle')
    Edit Category
@stop

@section('boxtitleright')
{!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
                         <button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</button>
                        {!! Form::close() !!}
@stop
@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		@section('boxcontent')
		    
		   
<form method="post" action="{{ route('categories.update', $category->id) }}">

 @method('PATCH')
        @csrf
		    	
		    	<div class="form-group text-left">
					<label>ID:</label>
	                {!! Form::text('id', $category->id,['class' => 'form-control', 'rows'=>'4', 'disabled']) !!}
				</div>

				<div class="form-group text-left {{ $errors->has('name') ? 'has-error' : '' }}">
					<label>Name:</label>
	                {!! Form::text('name', $category->name,['class' => 'form-control', 'rows'=>'4']) !!}
	                @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>

				<div class="form-group text-left {{ $errors->has('prefix') ? 'has-error' : '' }}">
					<label>Prefix:</label>
	                {!! Form::text('prefix', $category->prefix,['class' => 'form-control', 'rows'=>'4']) !!}
	                @if ($errors->has('prefix'))
                        <span class="help-block">
                            <strong>{{ $errors->first('prefix') }}</strong>
                        </span>
                    @endif
				</div>


				<a href="{{route('categories.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>
				<button class="btn btn-primary " type="submit"><span class="glyphicon glyphicon-ok"></span> Edit</button>
	    {!! Form::close()!!}

		@endsection

		@section('boxfooter')

		@endsection
		@include('layouts.box')
	</div>
</div>
@endsection