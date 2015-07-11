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
                        <form name="form-register" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="email">Password</label>
                                {{ Form::myInput('password','Password','password') }}
                            </div>
                            <div class="form-group">
                                {{ Form::myInput('password_confirmation','Password Confirmation','password') }}
                            </div>
                            <input type="hidden" name="id" value="{{ $reset_user->id }}">
                            <input type="hidden" name="token" value="{{ $reset_user->recovery_token }}">
                            <button class="btn btn-primary btn-block">
                                Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
