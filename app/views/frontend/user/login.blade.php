@extends('frontend.layout')

@section('title') Login @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Login</h1>
                <div class="well">
                    <form action="{{ route('guest.login') }}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">Email</label>
                            <div class="col-sm-10">
                                {{ Form::email('email',null,['class'=>"form-control"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">Password</label>
                            <div class="col-sm-10">
                                {{ Form::password('password',['class'=>"form-control"]) }}
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">
                            Login
                        </button>
                        <div class="text-center">
                            <br>
                            <a href="{{ route('guest.forgot.form') }}">
                                (If you forgot password click here)
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop