@extends('adminlte::page')

@section('title', 'Categories')

@section('boxtitle')
    Categories
@stop
@section('boxtitleright')
    <a href="{{route('categories.create')}}" class="btn btn-success">Create Category</a>
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-align-center"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Categories</span>
            <span class="info-box-number">{{$categories->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
	@section('boxcontent')
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<th style="width: 10px">ID</th>
    			<th>Name</th>
    			<th>Prefix</th>
    			<th>Total Leads</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($categories as $category)
    			<tr>
    				<td>{{$category->id}}</td>
    				<td>{{$category->name}}</td>
    				<td>{{$category->prefix}}</td>
    				<td>{{$category->leads->count()}}</td>
    				<td>
    					<a href="{{route('categories.edit', $category->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> Edit Category</a>

                         
    				</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
	@endsection

	@section('boxfooter')
		{{$categories->links()}}
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection