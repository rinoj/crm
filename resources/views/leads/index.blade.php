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
<div class="row">
  <div class="col-md-12">
  @section('boxcontent')
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($leads as $lead)
          <tr>
            <td>{{$lead->id}}</td>
            <td>{{$lead->name}}</td>
            <td>{{$lead->phone}}</td>
            <td>{{$lead->Email}}</td>
            <td>
              <a href="#" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit User</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection

  @section('boxfooter')
    {{$leads->links()}}
  @endsection
  @include('layouts.box')
  </div>
</div>
@endsection
