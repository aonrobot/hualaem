@extends('backend.layout')

@section('title') Application for {{$camp->name}} @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>Application for {{$camp->name}}</h1>
    </div>
</div>

<div class="row">
    <form method="GET" onsubmit="return false;">
        <div class="col-md-3">
            <input class="form-control input-sm" placeholder="Search By Username" id="txtSearchUser">
        </div>
        <div class="col-md-3">
            <input class="form-control input-sm" placeholder="YYYY-MM-DD"  id="txtSearchDate">
        </div>
    </form>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-success btn-sm" id="btnSelectAll">Select All</a>
        <a class="btn btn-warning btn-sm" id="btnSelectPending">Select Pending</a>
        <a class="btn btn-info btn-sm" id="btnSelectReceived">Select Document Received</a>
        <a class="btn btn-primary btn-sm" id="btnSelectApproved">Select Approved</a>
    </div>
</div>
<br>

<form method="POST">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Registered Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($camp->enrolls as $enroll)
                <tr>
                    <td><input type="checkbox" name="selected[]" value="{{ $enroll->id }}" class="chk-select" data-status="{{$enroll->status}}"></td>
                    <td>{{ $enroll->user->fullname_th }}</td>
                    <td>{{ $enroll->created_at }}</td>
                    <td>
                        @if($enroll->status == \Enroll::STATUS_DOCUMENT_RECIEVED)
                            <button class="btn btn-primary btn-sm" name="approve" value="{{ $enroll->id}}">Approved</button>
                            <button class="btn btn-warning btn-sm" name="unapprove" value="{{ $enroll->id}}">Unapprove</button>
                        @elseif($enroll->status == \Enroll::STATUS_PENDING)
                            <button class="btn btn-info btn-sm" name="received" value="{{ $enroll->id}}">Received</button>
                        @elseif($enroll->status == \Enroll::STATUS_APPROVED)
                            <button class="btn btn-warning btn-sm" name="unapprove" value="{{ $enroll->id}}">Unapprove</button>
                        @elseif($enroll->status == \Enroll::STATUS_NOT_APPROVED)
                            <button class="btn btn-primary btn-sm" name="approve" value="{{ $enroll->id}}">Approved</button>
                        @endif
                        <button type="button" class="btn btn-success btn-sm btn-field-data"  data-id="{{$enroll->id}}"
                                data-name="{{ $enroll->user->fullname_th }}">
                            View Writing
                        </button>
                        <button class="btn btn-danger btn-sm" name="delete" value="{{ $enroll->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-sm" type="submit" name="action" value="Approved">Approve All Selected</button>
            <button class="btn btn-primary btn-sm" type="submit" name="action" value="Received">Received All Selected</button>
            <button class="btn btn-warning btn-sm" type="submit" name="action" value="Unapproved">Unapprove All Selected</button>
            <button class="btn btn-info btn-sm" type="submit" name="action" value="Print">Print All Selected</button>
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
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}

<script>
    (function () {
        var modal = $('#modalFieldData');
        $('.btn-field-data').click(function () {
            var obj = $(this);
            modal.find('#myModalLabel').text(obj.data('name'));
            modal.find('.modal-body').text('Please wait....');
            modal.find('.modal-body').load("{{ URL::route('ajax.admin.camp.camp_fields') }}/" + obj.data('id'));
            modal.modal('show');
        });

        $('#btnSelectAll').click(function () {
            $('.chk-select').prop('checked', true);
        });

        $('#btnSelectPending').click(function () {
            $('.chk-select[data-status={{ \Enroll::STATUS_PENDING }}]').prop('checked', true);
        });
        $('#btnSelectReceived').click(function () {
            $('.chk-select[data-status={{ \Enroll::STATUS_DOCUMENT_RECIEVED }}]').prop('checked', true);
        });

        $('#btnSelectApproved').click(function () {
            $('.chk-select[data-status={{ \Enroll::STATUS_APPROVED }}]').prop('checked', true);
        });

        function filter() {
            var name = $('#txtSearchUser').val();
            var date = $('#txtSearchDate').val();

            $('.row-data').each(function () {
                var pass = true;
                if (name !== '' && $(this).data('name').indexOf(name) === -1) {
                    pass = false;
                }
                if (date !== '' && $(this).data('date') !== date) {
                    pass = false;
                }


                if (pass) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

        }

        $('#txtSearchUser').keyup(filter);

        $('#txtSearchDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#txtSearchDate').on('dp.change', filter);
    })();

</script>

@stop