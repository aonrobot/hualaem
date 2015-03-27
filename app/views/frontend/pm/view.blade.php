@extends('backend.layout')

@section('title') {{ $pmGroup->topic }} @stop

@section('css')
    @parent
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $pmGroup->topic }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        @foreach($pmGroup->datas as $obj)
        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <strong>{{ $obj->sender->fullname_th }}</strong> ({{  $obj->created_at }})
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $obj->message }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop

@section('js_foot')
    @parent

@stop