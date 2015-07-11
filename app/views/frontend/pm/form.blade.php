@extends('frontend.layout')

@section('title') Create Private Message @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Private Message</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="well">
            <form method="POST" class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="to" class="col-sm-2 control-label">To:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $to->fullname_th }}</p>
                                <input type="hidden" name="to" value="{{ $to->id }}">
                            </div>
                        </div>
                        {{ Form::bsInlineGroup('Title','title') }}
                        <div class="form-group">
                            <label for="to" class="col-sm-2 control-label">Message:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="message" name="message" placeholder="Message"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
