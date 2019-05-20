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

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $outcome->name, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('name', 'ABBR') }}
            {{ Form::text('abbr', $outcome->abbr, array('class' => 'form-control')) }}
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