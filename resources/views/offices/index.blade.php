@extends('adminlte::page')

@section('title', 'Offices')


@section('content')
@section('boxtitle')
    Offices
@stop
<div class="row">
	<div class="col-md-12">
	@section('boxcontent')
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<th>Office Name</th>
    			<th>URL</th>
                <th>API</th>
                <th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($offices as $office)
                <tr>
                    <td>(ID: {{$office->id}}) {{$office->name}}</td>
                    <td>{{$office->url}}</td>
                    <td>{{$office->api}}</td>
                    <td><a href="{{route('offices.show', $office->id)}}" class="btn btn-info">Show</a></td>
                </tr>
                @endforeach
    	</tbody>
    </table>
	@endsection

	@section('boxtitleright')
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection