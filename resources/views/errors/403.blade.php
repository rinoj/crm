@extends('adminlte::page')

@section('title', 'Error 404')


@section('content')

	<div class="error-page">
        <h2 class="headline text-red"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Access forbidden.</h3>

          <p>
           	You do not have access to view this page.
            Meanwhile, you may <a href="{{route('index')}}">return to dashboard</a>.
          </p>

        </div>
        <!-- /.error-content -->
      </div>

@endsection