@extends('adminlte::page')

@section('title', 'Appointments')

@section('boxtitle')
    Create Category
@stop



@section('css')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <style type="text/css">
    	/*new css with styling on a container div instead of the body*/
	.container {
	  	position: relative;
	  	width: 980px;
	  	margin:0 auto;
	}

	#sample-menu{
	  	position: absolute;
	  	top: 109px;
	  	left: 600px;
	}
	.fc-event {
	    border: 1px solid #3a87ad; /* default BORDER color */
	    background-color: #3a87ad; /* default BACKGROUND color */
	    color: #fff;               /* default TEXT color */
	    font-size: 1em;            /* EDIT HERE */
	    cursor: default;
	}

    </style>
@endsection

@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">

	    <div class="panel panel-primary">

	        <div class="panel-heading">

	          	Appointments

	        </div>

	        <div class="panel-body" >

	            {!! $calendar->calendar() !!}


	        </div>

	    </div>
	</div>
</div>


@endsection
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

	            {!! $calendar->script() !!}
@endsection