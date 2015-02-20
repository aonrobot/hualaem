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
                <div class="pull-right">
                    <a href="{{ URL::route('student.camp.register',[$camp->id]) }}" class="btn btn-info">Register</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('js_foot')
@parent

@stop