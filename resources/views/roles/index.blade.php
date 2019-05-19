@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">
	@section('boxcontent')
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<th>Role Name</th>
    			<th>Can</th>
                <th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
    	</tbody>
    </table>
	@endsection

	@section('boxtitle')
    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default">Permissions</a></h1>
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection