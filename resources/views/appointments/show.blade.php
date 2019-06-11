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
            Appointments
		@stop
		<div class="row">
			<div class="col-md-12">
    			@section('boxcontent')
    			<ul class="timeline timeline-inverse">
                    
    		    	@foreach($lead->appointments->sortByDesc('start_date') as $appointment)
                        <li class="time-label">
                            <span class="bg-gray">
                                {{$appointment->start_date}}
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-comment bg-blue"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{$appointment->created_at}}</span>

                                <h3 class="timeline-header"><a href="#">{{$appointment->user->name}}</a> commented</h3>

                                <div class="timeline-body">
                              	 {{$appointment->title}}
                                </div>
                            </div>
                        </li>
                    @endforeach
                      
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>

    			@endsection
                @include('layouts.box')     
			</div>
            <form id="myform">
                <div class="col-md-8">

                        <div class="form-group">

                            <input type="hidden" id="lead_id" name="lead_id"  class="lead_id" value="{{$appointment->lead->id}}">
                            {{ Form::label('name', 'Comment') }}
                            {!! Form::textarea('comment', null,['id' => 'comment', 'class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <button class="btn btn-primary" id="ajaxSubmit" data-dismiss="modal">Comment</button>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" id="setappointment"> Set another appointment
                    <div class="panel" id="appointmenttab" style="display: none">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="date" id="reservation" autocomplete="off">
                        </div>
                                    <!-- /.input group -->
                            
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Time picker:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="time" id="time" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('#reservation').datepicker({
         minDate: +1,
      autoclose: true
    })

    $('.timepicker').timepicker({
      showInputs: false,
        stepMinute: 15,
      timeFormat: 'HH:mm',
    })

    $(document).ready(function () {
        $("#setappointment").change(function () {
            $("#appointmenttab").fadeToggle();
        });
    });
    $(document).ready(function(){

    var lastcommented = 0;
    $('.comment').on('click', function(e) {
        var modal = $('#myModal');
        //modal.find('.modal-body #lead_id').val(this.dataset.leadid);
        $('input[name="lead_id"]').val(this.dataset.leadid);
    });
    $('#ajaxSubmit').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('storeComment') }}",
            method: 'post',
            dataType: 'json',
            data: {
                comment: jQuery('#comment').val(),
                lead_id: $('#lead_id').val(),
                time: $('#time').val(),
                date: $('#reservation').val(),
            },
            success: function(success){
                //var obj = JSON.stringify(response);
                if(success.success != null){
                    var cmt = success.success.comment.comment;
                    var leadcount = success.success.leadcount;
                    var leadid = success.success.comment.lead_id;
                    var leadname = success.success.leadname;
                    //console.log(response.leadcount);
                    $('.commentbox'+leadid).html(cmt.substr(0, 50)+ " ("+leadcount+")");
                    $('#comment').val("");
                    toastr.success(success.success.msg);
                    console.log(lastcommented);
                    //$('.commentbox'+lastcommented).toggleClass('btn-info').toggleClass('btn-default');
                    $('.commentbox'+leadid).toggleClass('btn-default').toggleClass('btn-info');
                    lastcommented = leadid;
                    $('#reservation').val('');
                    $('#appointmenttab').hide();
                    $('#setappointment').prop('checked', false);
                }
                else{

                toastr.error('Please write a comment.'); // An array with all errors.
                }
            },
            
        });
    });
});
</script>
@endsection