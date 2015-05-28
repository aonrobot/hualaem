@extends('frontend.layout')

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

                @if(Auth::check())
                    @if($enroll)
                        @if($enroll->status == Enroll::STATUS_PENDING)
                            <div class="pull-right">
                                <div class="btn btn-warning">PENING</div>
                            </div>
                        @elseif($enroll->status == Enroll::STATUS_DOCUMENT_RECIEVED)
                            <div class="pull-right">
                                <div class="btn btn-info">RECEIVED DOCUMENT</div>
                            </div>
                        @elseif($enroll->status == Enroll::STATUS_APPROVED)
                            <div class="pull-right">
                                <div class="btn btn-success">APPROVED</div>
                            </div>
                        @elseif($enroll->status == Enroll::STATUS_NOT_APPROVED)
                            <div class="pull-right">
                                <div class="btn btn-danger">NOT APPROVED</div>
                            </div>
                        @endif
                    @elseif($camp->open_for_register)
                        <div class="pull-right">
                            <a href="{{ URL::route('student.camp.register',[$camp->id]) }}" class="btn btn-info">Register</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('js_foot')
@parent

@stop