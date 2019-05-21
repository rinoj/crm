@extends('adminlte::page')

@section('title', 'Error 404')


@section('content')

	<div class="error-page">
        <h2 class="headline text-red"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{{route('index')}}">return to dashboard</a>.
          </p>

        </div>
        <!-- /.error-content -->
      </div>

@endsection