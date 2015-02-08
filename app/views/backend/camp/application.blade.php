@extends('frontend.layout')

@section('title') Application for {{$camp->name}} @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Application for {{$camp->name}}</h1>
        </div>
    </div>
</div>

<form method="POST">
    <div class="container well">
        <div class="row">
            <div class="col-md-3">
                <input class="form-control input-sm" placeholder="Search By Username">
            </div>
            <div class="col-md-3">
                <input class="form-control input-sm" placeholder="Select Date">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success btn-sm" id="btnSelectAll">Select All</a>
                <a class="btn btn-warning btn-sm" id="btnSelectPending">Select Pending</a>
                <a class="btn btn-primary btn-sm" id="btnSelectApproved">Select Approved</a>
            </div>
        </div>
        <br>
        @foreach($camp->enrolls as $enroll)
        <div class="row well">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="selected[]" value="{{ $enroll->id }}" class="chk-select" data-status="{{$enroll->status}}"> 
                        {{ $enroll->user->firstname_th }} {{ $enroll->user->lastname_th }}
                    </label>
                </div>

                {{ $enroll->created_at }}<br>
                @if($enroll->status == \Enroll::STATUS_PENDING)
                <button class="btn btn-info btn-sm" name="approve" value="{{ $enroll->id}}">Approved</button>
                @elseif($enroll->status == \Enroll::STATUS_APPROVED)
                <button class="btn btn-warning btn-sm" name="unapprove" value="{{ $enroll->id}}">Unapprove</button>
                @endif
                <button type="button" class="btn btn-success btn-sm btn-field-data"  data-id="{{$enroll->id}}"
                        data-name="{{ $enroll->user->firstname_th }} {{ $enroll->user->lastname_th }}">
                    View Writing
                </button>
                <button class="btn btn-danger btn-sm" name="delete" value="{{ $enroll->id}}">Delete</button>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-sm" type="submit" name="action" value="Approved">Approve All Selected</button>
                <button class="btn btn-warning btn-sm" type="submit" name="action" value="Unapproved">Unapprove All Selected</button>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="modalFieldData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('js_foot')
@parent
<script>
    (function () {
        var modal = $('#modalFieldData');
        $('.btn-field-data').click(function(){
            var obj = $(this);
            modal.find('#myModalLabel').text(obj.data('name'));
            modal.find('.modal-body').text('Please wait....');
            modal.find('.modal-body').load("{{ URL::route('ajax.admin.camp.camp_fields') }}/"+obj.data('id'));
            modal.modal('show');
        });

        $('#btnSelectAll').click(function () {
            $('.chk-select').prop('checked', true);
        });

        $('#btnSelectPending').click(function () {
            $('.chk-select[data-status=PENDING]').prop('checked', true);
        });

        $('#btnSelectApproved').click(function () {
            $('.chk-select[data-status=APPROVED]').prop('checked', true);
        });
    })();

</script>

@stop