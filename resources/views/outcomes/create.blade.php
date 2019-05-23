@extends('adminlte::page')

@section('title', 'Add Outcome')

@section('boxtitle')
    Add Outcome
@stop
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
    @section('boxcontent')

    
    <div class="col-md-12">
    {{ Form::open(array('url' => 'outcomes')) }}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('abbr') ? 'has-error' : '' }}">
        {{ Form::label('name', 'ABBR') }}
        {{ Form::text('abbr', null, array('class' => 'form-control')) }}
        @if ($errors->has('abbr'))
            <span class="help-block">
                <strong>{{ $errors->first('abbr') }}</strong>
            </span>
        @endif
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

    </div>  
    @endsection

    @section('boxtitleright')
    <a href="{{ URL::to('outcomes') }}" class="btn btn-success">Outcomes</a>
    @endsection
    @include('layouts.box')
    </div>
</div>
@endsection