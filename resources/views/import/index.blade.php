@extends('adminlte::page')

@section('title', 'Import')


@section('content')
@section('boxtitle')
    Import Leads
@stop
<div class="row">
	<div class="col-md-6 col-md-offset-3">
	@section('boxcontent')
    	<div class="card-body">
            @if(Session::has('success'))
                <p class="alert alert-info">{{ Session::get('success') }}</p>
            @endif
            <form action="{{ route('importstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                
                </div>
                <br>
              
                <div class="form-group">
                <button class="btn btn-success">Import Lead Data</button>
            </div>
            </form>
        </div>
	@endsection

	@include('layouts.box')
	</div>
</div>
@endsection