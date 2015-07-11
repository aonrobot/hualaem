@extends('frontend.layout')

@section('title') Forgot Password @stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>
                    <img src="{{ asset('images/1415873536_user-id-64.png') }}" alt="54642fce3c195bec149176d9_1415873536_user-id-64.png">
                    Forgot Password
                </h1>

                <div class="well">
                    <div>
                        <form name="form-register" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="email">อีเมลล์</label>
                                <div class="col-sm-10">
                                    {{ Form::email('email',null,['class'=>"form-control"]) }}
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block">
                                Send Recovery Email
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
