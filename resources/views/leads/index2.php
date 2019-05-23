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
                    <button type="button" class="comment btn btn-default" data-toggle="modal" data-leadid={{$lead->id}} data-target="#myModal">Comment</button>

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Category</h4>
      </div>
      <form action="{{route('storeComment')}}" method="post">
            {{csrf_field()}}
          <div class="modal-body">
                <div class="form-group text-left {{ $errors->has('name') ? 'has-error' : '' }}"> 
                    
                    <input type="hidden" id="lead_id" name="lead_id"  class="lead_id" value="">
                    <label>Comment:</label>
                    {!! Form::textarea('comment', null,['class' => 'form-control', 'rows' => '3']) !!}
                    
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
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

<script>
    $(document).ready(function() {
      $('.comment').on('click', function(e) {
        e.preventDefault();
      var modal = $('#myModal');
        //modal.find('.modal-body #lead_id').val(this.dataset.leadid);
        $('input[name="lead_id"]').val(this.dataset.leadid);
        console.log(this.dataset.leadid);
      });
    });
     $('#myModal').on('show.bs.modal', function (event) {
        alert('test')
      var button = $(event.relatedTarget) 
      var lead_id = button.data('leadid') 
      var modal = $(this)
      modal.find('.modal-body #lead_id').val(lead_id);
      alert(lead_id);
})
</script>
@endsection