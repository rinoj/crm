@extends('adminlte::page')

@section('title', 'Leads')

@section('boxtitle')
Leads
@stop

@section('boxtitleright')
    @if(Auth::user()->isAdmin())
        <a href="{{route('exportleads')}}" class="btn btn-success"> Export Leads</a>
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
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th width="10%">Name</th>
              <th width="10%">Phone</th>
              <th width="10%">Email</th>
              @if(Auth::user()->isAdmin())
                <th width="10%">Lead of</th>
              @endif
              <th width="20%">Comment</th>
              <th width="10%">Action</th>
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
                    <td>
                        <select class="setlead selectpicker form-control setleads{{$lead->id}}" id="{{$lead->id}}">
                        @if($lead->user == null)
                            <option value="">+</option>
                        @else
                            @foreach($users as $agent)
                                <option value="{{$agent->id}}" {{$agent->id == $lead->user->id ? 'selected' : ''}}>{{$agent->name}}</option>
                            @endforeach
                        @endif
                        </select>
                    </td>
                @endif
                <td>
                    <button type="button" class="comment commentbox{{$lead->id}} btn btn-default btn-block" data-toggle="modal" data-leadid={{$lead->id}} data-target="#myModal">
                    @if(!$lead->comments->isEmpty())
                      {{  substr($lead->comments->last()->comment, 0, 50) }}{{ strlen($lead->comments->last()->comment) > 50 ? "..." : "" }} ({{ $lead->comments->count()}})
                    @else
                        Comment
                    @endif
                    </button>

                </td>
                <td>
                      
                    <select class="outcomeselect selectpicker" id="{{$lead->id}}">
                        @if($lead->outcome == null)
                            <option value="" class="">+</option>
                        @endif
                        @foreach($outcomes as $outcome)
                            <option value="{{$outcome->id}}" {{$lead->outcome_id == $outcome->id ? 'selected' : ''}}>{{$outcome->name}}</option>
                        @endforeach
                    </select>
                    <input type="checkbox" class="pull-right checkBoxClass" name="leadselect" value="{{ $lead->id }}"/>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Comment</h4>
      </div>
      <form id="myform">
            <div class="modal-body row">
                <div class="col-md-8">
                    <div class="form-group text-left {{ $errors->has('name') ? 'has-error' : '' }}"> 
                        
                        <input type="hidden" id="lead_id" name="lead_id"  class="lead_id" value="">

                        {!! Form::textarea('comment', null,['id' => 'comment', 'class' => 'form-control', 'rows' => '3']) !!}
                        
                        <div class="listcomments pre-scrollable">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" id="setappointment"> Set an appointment
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

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="ajaxSubmit" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </form>
    </div>
  </div>
</div>

    @section('boxfooter')
    <div class="row">
        <div class="col-md-6">
            {{$leads->links()}}
        </div>
        <div class="col-md-2 col-md-offset-4 text-right">
            <input type="checkbox" id="checkAll" /> Check All<br>
            <select class="setagent form-control pull-right" style="width: 150px">
                @foreach($users as $agent)
                    <option value="{{$agent->id}}">{{$agent->name}}</option>
                @endforeach
            </select>
            <button class="btn btn-default" id="setleads">Set Leads</button>
        </div>
    </div>
    @endsection
    @endsection
    @include('layouts.box')
    </div>

</div>
@endsection

@section('js')

<script type="text/javascript">
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
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
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#checkAll").prop("checked",false);
        }
    });
});
$(document).ready(function () {
    $("#checkAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#checkAll").prop("checked",false);
        }
    });
});
    
$('#setleads').on('click', function(e) {
    var checkedValues = $('input[name="leadselect"]:checked').map(function() {
        return this.value;
    }).get();
    var selectedAgent = $('.setagent').val();
    console.log(checkedValues.length);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        url: "{{route('setleads')}}",
        method: 'POST',
        data: {
            checkboxes: checkedValues,
            agent: selectedAgent,
        },
        success: function(data){
            if(checkedValues.length > 0){
                checkedValues.forEach(function(element) {
                    $('.setleads'+element).val(selectedAgent);
                });
                toastr.success(data);
                    $('.selectpicker').selectpicker('refresh');
            }
            else{
                toastr.error(data);
            }
        },
        complete: function(data) {
            var dt = $.parseJSON(data.responseText)
        }
    });
});
$('.setlead').change(function(e){
    var lead_id = $(this).attr('id');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        url: "{{route('setlead')}}",
        method: 'POST',
        data: {
            user_id: $(this).val(),
            lead_id: $(this).attr('id'),
        },
        success: function(data){
            toastr.success(data);
        },
        complete: function(data) {
            var dt = $.parseJSON(data.responseText)
        }
    });
});

$('.outcomeselect').change(function(e){
    var lead_id = $(this).attr('id');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        url: "{{route('changeoutcome')}}",
        method: 'POST',
        data: {
            outcome_id: $(this).val(),
            lead_id: $(this).attr('id'),
        },
        success: function(data){
            toastr.success(data);
        },
    });
});
$(document).ready(function(){

    var lastcommented = 0;
    $('.comment').on('click', function(e) {
        var modal = $('#myModal');
        //modal.find('.modal-body #lead_id').val(this.dataset.leadid);
        $('input[name="lead_id"]').val(this.dataset.leadid);
        fetchRecords(this.dataset.leadid);
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
function fetchRecords(id){
    $.ajax({
        url: '/leadcomment/'+id,
        type: 'get',
        dataType: 'json',
        success: function(response){
            var len = 0;
            $('.listcomments').empty(); // Empty <tbody>
            if(response['data'] != null){
                len = response['data'].length;
            }
            
            if(len > 0){
                for(var i=0; i<len; i++){
                    var comment = response['data'][i].comment;
                    var created_at = response['data'][i].created_at;
                    var user = response['data'][i].user.name;
                    var cmt = '<div class="box box-primary"><div class="box-header with-border"><div class="boxtitle">'+user+'</div><div class="box-tools pull-right">'+created_at+'</div></div><div class="box-body"><div class="col-md-12" style="word-wrap: break-word;"><p>'+ comment +'</p></div></div></div>';
                    //var tr_str = "<p>" + comment + "</p>";

                    $(".listcomments").append(cmt);
                }
            }
            else{
                var tr_str = "<p>No comments found.</p>";

                $(".listcomments").append(tr_str);
            }
        }
    });
}
</script>
@endsection