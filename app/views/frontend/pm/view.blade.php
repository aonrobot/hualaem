@extends('frontend.layout')

@section('title') Message: {{ $pmGroup->topic }} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Message: {{ $pmGroup->topic }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        @foreach($pmGroup->datas as $obj)
        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ URL::route('user.profile.view',[$obj->sender->id]) }}">
                    <strong>{{ $obj->sender->fullname_th }}</strong>
                    </a>
                    ({{  $obj->created_at }})
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

    <div class="container">
        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" class="form-horizontal" action="{{ URL::route('user.pm.reply') }}">
                        <textarea class="form-control" name="message"></textarea>
                        <input type="hidden" name="group" value="{{ $pmGroup->id }}">
                        @if($pmGroup->sender->id != Auth::user()->id)
                            <input type="hidden" name="to" value="{{ $pmGroup->sender->id }}">
                        @else
                            <input type="hidden" name="to" value="{{ $pmGroup->groupUsers()->first()->user->id }}">
                        @endif
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
