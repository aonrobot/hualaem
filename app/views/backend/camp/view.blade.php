@extends('backend.layout')

@section('title') {{ $camp->name }} @stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>{{ $camp->name }}</h1>
        {{ $camp->description }}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>
            Applicants
            <a href="{{ URL::route('admin.camp.camp_score',[$camp->id]) }}" class="btn btn-info btn-sm">Scores</a>
        </h2>
    </div>
</div>
<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Registed Time</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($camp->enrolls as $enroll)
            <tr>
                <td>{{ $enroll->user->fullname_th }}</td>
                <td>{{ $enroll->created_at }}</td>
                <td>
                    <a href="{{ URL::route('admin.camp.score',[$enroll->id])}}" class="btn btn-info btn-sm">Score</a>
                    <button type="button" class="btn btn-success btn-sm btn-field-data"  data-id="{{$enroll->id}}"
                            data-name="{{ $enroll->user->fullname_th }}">
                        View Writing
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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