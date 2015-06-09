@extends('frontend.layout')

@section('title') Forgot Password @stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <img src="{{ asset('images/1415873536_user-id-64.png') }}" alt="54642fce3c195bec149176d9_1415873536_user-id-64.png">
                    Forgot Password
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <div class="well">
                <div>
                    <div class="w-form">
                        <form name="form-register" method="POST" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        <label class="label register" for="email">อีเมลล์</label>
                                        {{ Form::myInput('email','Email','email') }}
                                    </div>
                                    <button class="btn btn-primary btn-block">
                                        Send Recovery Email
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js_foot')
    @parent
@stop