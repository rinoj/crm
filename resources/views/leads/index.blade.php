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
              <th >Comment</th>
              <th style="width: 200px">Action</th>
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
                    <button type="button" class="comment commentbox{{$lead->id}} btn btn-default btn-block" data-toggle="modal" data-leadid={{$lead->id}} data-target="#myModal">
                    @if(!$lead->comments->isEmpty())
                      {{  substr($lead->comments->last()->comment, 0, 50) }}{{ strlen($lead->comments->last()->comment) > 50 ? "..." : "" }} ({{ $lead->comments->count()}})
                    @else
                        Comment
                    @endif
                    </button>

                </td>
                <td>
                    <select class="outcomeselect select selectpicker" id="{{$lead->id}}">
                        @foreach($outcomes as $outcome)
                            <option value="{{$outcome->id}}" {{$lead->outcome->id == $outcome->id ? 'selected' : ''}}>{{$outcome->name}}</option>
                        @endforeach
                    </select>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Comment</h4>
      </div>
      <form id="myform">
            <div class="modal-body">
                <div class="form-group text-left {{ $errors->has('name') ? 'has-error' : '' }}"> 
                    
                    <input type="hidden" id="lead_id" name="lead_id"  class="lead_id" value="">
                    <label>New Comment:</label>

                    {!! Form::textarea('comment', null,['id' => 'comment', 'class' => 'form-control', 'rows' => '3']) !!}
                    
                    <div class="listcomments pre-scrollable">
                        
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
        {{$leads->links()}}
    @endsection
    @endsection
    @include('layouts.box')
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
$(document).ready(function() {
  $('#dropdownList li').find("a").click(function(){
    
    $('#dropdown-button').html($(this).html()).append("    <span class='caret'></span>");
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
            // if ( data.error)  alert(data.error);
        },
        complete: function(data) {
            var dt = $.parseJSON(data.responseText)
        }
    });
});
$(document).ready(function(){
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
            url: "{{ url('/leadcomments/post') }}",
            method: 'post',
            data: {
                comment: jQuery('#comment').val(),
                lead_id: $('#lead_id').val(),
            },
            success: function(data){
                $('#comment').val("");
                // if ( data.error)  alert(data.error);
            },
            complete: function(data) {
                var dt = $.parseJSON(data.responseText)
                $('.commentbox'+dt.lead_id).html(dt.comment.substring(0, 30));
            }
        });
    });
});
function fetchRecords(id){
    $.ajax({
        url: 'leadcomment/'+id,
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
                var tr_str = "<tr>" + "<td align='center' colspan='4'>No record found.</td>" +
                  "</tr>";

                $(".listcomments").append(tr_str);
            }
        }
    });
}
</script>
@endsection