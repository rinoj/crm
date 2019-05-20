@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number">{{$users->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-male"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Leads</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box">
          <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-default"><i class="fa fa-align-center"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Categories</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
    </div>

</div>
@stop