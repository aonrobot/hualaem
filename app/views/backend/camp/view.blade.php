@extends('backend.layout')

@section('title') {{ $camp->name }} @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $camp->name }}</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                {{ $camp->description }}
            </div>
        </div>
    </div>
</div>

<div class="container ">
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    Applicants 
                    <a href="{{ URL::route('admin.camp.camp_score',[$camp->id]) }}" class="btn btn-info btn-sm">Scores</a>
                </h2>
            </div>
        </div>
        @foreach($camp->enrolls as $enroll)
        <div class="row well row-data">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="selected[]" value="{{ $enroll->id }}" class="chk-select" data-status="{{$enroll->status}}"> 
                                {{ $enroll->user->fullname_th }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">{{ $enroll->created_at }}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ URL::route('admin.camp.score',[$enroll->id])}}" class="btn btn-info btn-sm">Score</a>
                        <button type="button" class="btn btn-success btn-sm btn-field-data"  data-id="{{$enroll->id}}"
                                data-name="{{ $enroll->user->fullname_th }}">
                            View Writing
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


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
        $('.btn-field-data').click(function () {
            var obj = $(this);
            modal.find('#myModalLabel').text(obj.data('name'));
            modal.find('.modal-body').text('Please wait....');
            modal.find('.modal-body').load("{{ URL::route('ajax.admin.camp.camp_fields') }}/" + obj.data('id'));
            modal.modal('show');
        });
    })();

</script>
@stop