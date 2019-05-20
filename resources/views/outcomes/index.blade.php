@extends('adminlte::page')

@section('title', 'Outcomes')


@section('content')
@section('boxtitle')
    Outcomes
@stop
<div class="row">
	<div class="col-md-12">
	@section('boxcontent')
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<th width="25%">ID</th>
    			<th width="25%">Name</th>
                <th width="25%">Abbreviation</th>
                <th width="25%">Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($outcomes as $outcome)
                <tr>

                    <td>{{ $outcome->id }}</td>
                    <td>{{ $outcome->name }}</td>
                    <td>{{ $outcome->abbr }}</td>
                    <td>
                    <a href="{{ URL::to('outcomes/'.$outcome->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                   

                    </td>
                </tr>
                @endforeach
    	</tbody>
    </table>
	@endsection

	@section('boxtitleright')
    <a href="{{ URL::to('outcomes/create') }}" class="btn btn-success">Add Outcome</a>
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection