@extends('backend.layout')

@section('title') Profile: {{ $user->fullname_th }} @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profile</h1>
        </div>
    </div>
</div>

<div class="container well">
    <div class="row">
        <div class="col-md-12">
            <h2>
                {{ $user->fullname_th }} 
                @if($user->role == 'VERIFIED')
                <span class="glyphicon glyphicon-ok"></span>
                @elseif($user->role == 'UNVERIFIED')
                <span class="glyphicon glyphicon-remove"></span>
                @endif
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="POST" class="form-horizontal" id="rootform">
                <div role="tabpanel" ng-app="UserForm">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic</a>
                        </li>
                        <li role="presentation">
                            <a href="#addresses" aria-controls="addresses" role="tab" data-toggle="tab">Addresses</a>
                        </li>
                        <li role="presentation">
                            <a href="#parents" aria-controls="parents" role="tab" data-toggle="tab">Parents</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="basic">
                            {{ Form::bsInlineGroup('Name','user[firstname_th]',$user->firstname_th) }}
                            {{ Form::bsInlineGroup('Lastname','user[lastname_th]',$user->lastname_th) }}
                            {{ Form::bsInlineGroup('Nickname','user[nickname]',$user->nickname) }}
                            {{ Form::bsInlineGroup('Birthdate','user[birthdate]',$user->birthdate) }}
                            {{ Form::bsInlineGroup('Citizen ID','user[citizen_id]',$user->citizen_id) }}
                            {{ Form::bsInlineGroup('Mobile','user[mobile_no]',$user->mobile_no) }}
                            {{ Form::bsInlineGroup('Email','user[email]',$user->email) }}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="addresses">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <address-list></address-list>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="parents">
                            <parent-list></parent-list>
                        </div>
                    </div>

                </div>

                <div class="pull-right">
                    <button type="submit" class="btn btn-success" ng-click="document.getElementById('rootform').submit();">Save Change</button>
                </div>
            </form>
        </div>
    </div>

</div>




@stop

@section('js_foot')
@parent

{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}

<script>
    var parents = {{ json_encode($user->parents) }};
    var addresses = {{ json_encode($user->addresses) }};
    var provinces = {{ json_encode($provinces) }};
    var districts = {{ json_encode($districts) }};
    var subDistricts = {{ json_encode($subDistricts) }};
    (function () {
        $('#user\\[birthdate\\]').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    })();

</script>

{{ HTML::script('js/angular.min.js') }}
{{ HTML::script('js/angular_modules/user_form.js') }}

@stop