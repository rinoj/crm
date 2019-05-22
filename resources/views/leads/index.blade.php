@extends('adminlte::page')

@section('title', 'Leads')

@section('boxtitle')
Leads
@stop

@section('boxtitleright')
    @if(Auth::user()->isAdmin())
        <a href="#" class="btn btn-success"> Import Leads</a>
    @endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Leads</span>
            <span class="info-box-number">{{$leads->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <div class="btn-group">
            <a href="{{route('leads')}}" class="btn btn-default {{$category_id == null ? 'active' : ''}} {{$category_id == 'all' ? 'active' : ''}}">All</a>
            @foreach($categories as $category)
                <a href="{{route('leads',$category->id)}}" class="btn btn-default {{$category_id == $category->id ? 'active' : ''}}">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <div class="btn-group">
            @if($category_id == null)
                <a href="{{route('leads', ['all'])}}" class="btn btn-default {{$outcome_id == null ? 'active' : ''}} active">All</a>
            @else
                <a href="{{route('leads', [$category_id])}}" class="btn btn-default {{$outcome_id == null ? 'active' : ''}}">All</a>
            @endif
            @foreach($outcomes as $outcome)
                @if($category_id == 'all')
                    <a href="{{route('leads',['all', $outcome->id])}}" class="btn btn-default {{$outcome_id == $outcome->id ? 'active' : ''}}">{{$outcome->name}}</a>
                @elseif($category_id == null)
                    <a href="{{route('leads',['all', $outcome->id])}}" class="btn btn-default {{$outcome_id == $outcome->id ? 'active' : ''}}">{{$outcome->name}}</a>
                @else
                    <a href="{{route('leads',[$category_id, $outcome->id])}}" class="btn btn-default {{$outcome_id == $outcome->id ? 'active' : ''}}">{{$outcome->name}}</a>
                @endif
            @endforeach
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
              <th>Phone</th>
              <th>Email</th>
              @if(Auth::user()->isAdmin())
                <th>Lead of</th>
              @endif
              <th>Comment</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($leads as $lead)
              <tr>
                <td>{{$lead->id}}</td>
                <td>{{$lead->name}}</td>
                <td>{{$lead->phone}}</td>
                <td>{{$lead->email}}</td>
                @if(Auth::user()->isAdmin())
                    <td>{{$lead->user != null ? $lead->user->name : "+"}}</td>
                @endif
                <td>
                    <a href="#" class="btn btn-default">Comment</a>
                </td>
                <td>
                    <div class="btn-group">
                        <a target="_blank" href="#" class="btn btn-primary btn-sm" >{{$lead->outcome != null ? $lead->outcome->name : "+"}}</a>
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                            &nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Set Appointment</a></li>
                            <li><a href="#">Send Mail</a></li>
                            <li><a href="#">Edit Lead</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @section('boxfooter')
        {{$leads->links()}}
    @endsection
    @endsection
    @include('layouts.box')
    </div>
</div>
@endsection
