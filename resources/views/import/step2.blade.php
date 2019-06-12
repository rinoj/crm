@extends('adminlte::page')

@section('title', 'Import')


@section('content')
@section('boxtitle')
    Import Leads
@stop
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
	@section('boxcontent')
    	<form action="{{ route('importstore2') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                
                </div>
                <div class="form-group">
                    <label>Lead Name:</label>
                    <select class="setcategory form-control" name="leadname" >
                        @foreach($headings[0][0] as $heading)
                            <option value="{{$heading}}">{{$heading}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lead Email:</label>
                    <select class="setcategory form-control" name="leademail" >
                        @foreach($headings[0][0] as $heading)
                            <option value="{{$heading}}">{{$heading}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Phone Code:</label>
                    <select class="setcategory form-control" name="phonecode" >
                        <option></option>
                        @foreach($headings[0][0] as $heading)
                            <option value="{{$heading}}">{{$heading}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lead Phone:</label>
                    <select class="setcategory form-control" name="leadphone" >
                        @foreach($headings[0][0] as $heading)
                            <option value="{{$heading}}">{{$heading}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lead Comment:</label>
                    <select class="setcategory form-control" name="leadcomment" >
                        @foreach($headings[0][0] as $heading)
                            <option value="{{$heading}}">{{$heading}}</option>
                        @endforeach
                    </select>
                </div>
                
                  <div class="form-group">
                    <label>Category:</label>
                    <select class="setcategory form-control" name="category" >
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label>Agent:</label>
                    <select class="setcategory form-control" name="user" >
                        <option value=""> + </option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <button class="btn btn-success">Import Lead Data</button>
            </div>
        </form>	
	@endsection

	@section('boxtitleright')
	<a href="{{route('import')}}" class="btn btn-default"> Go Back</a>
	@endsection
	@include('layouts.box')
	</div>
</div>
@endsection