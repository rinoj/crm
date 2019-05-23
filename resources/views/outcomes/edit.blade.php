@extends('adminlte::page')

@section('title', 'Edit Outcome')

@section('boxtitle')
    Edit Outcome
@stop
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
    
    @section('boxcontent')
   
    
    @section('boxtitleright')
    <a href="{{ URL::to('outcomes') }}" class="btn btn-success">Outcomes</a>
    @endsection
    <div class='col-lg-12 '>

        {{ Form::model($outcome, array('route' => array('outcomes.update', $outcome->id), 'method' => 'PUT')) }}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', $outcome->name, array('class' => 'form-control')) }}
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        </div>
        <div class="form-group {{ $errors->has('abbr') ? 'has-error' : '' }}">
            {{ Form::label('abbr', 'ABBR:') }}
            {{ Form::text('abbr', $outcome->abbr, array('class' => 'form-control')) }}
            @if ($errors->has('abbr'))
            <span class="help-block">
                <strong>{{ $errors->first('abbr') }}</strong>
            </span>
        @endif
        </div>
        
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}    
    </div>

    @endsection

    @section('boxfooter')
    @endsection
    @include('layouts.box')
    </div>
</div>
@endsection