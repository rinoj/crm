@extends('adminlte::page')

@section('title', $lead->name)

@section('boxtitle')
    {{$lead->name}} - Appointments
@stop



@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-body box-profile">

              	<h3 class="profile-username text-center">{{$lead->name}}</h3>

              	<p class="text-muted text-center">{{$lead->phone}}</p>

              	<ul class="list-group list-group-unbordered">
	                <li class="list-group-item">
	                  <b>Appointments</b> <a class="pull-right">{{$lead->appointments->count()}}</a>
	                </li>
	                <li class="list-group-item">
	                  <b>Comments</b> <a class="pull-right">{{$lead->comments->count()}}</a>
	                </li>
        		</ul>

            </div>
        </div>
    </div>
	<div class="col-md-8">
		@section('boxtitle')

		@stop
		<div class="row">
			<div class="col-md-12">
			@section('boxcontent')
			<ul class="timeline timeline-inverse">
                  <!-- timeline time label -->

		    	@foreach($lead->appointments->sortByDesc('start_date') as $appointment)
                  <li class="time-label">
                        <span class="bg-gray">
                          {{$appointment->start_date}}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{$appointment->created_at}}</span>

                      <h3 class="timeline-header"><a href="#">{{$appointment->user->name}}</a> commented</h3>

                      <div class="timeline-body">
                      	{{$appointment->title}}
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  
		    	@endforeach
                  
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
			@endsection

			@section('boxtitleright')
			@endsection
			@include('layouts.box')
			</div>
		</div>

	</div>
</div>
@endsection
@section('js')

@endsection