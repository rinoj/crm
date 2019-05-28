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
            <form action="{{ route('importstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Lead Data</button>
            </form>
        </div>
	@endsection

	@section('boxtitleright')
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection