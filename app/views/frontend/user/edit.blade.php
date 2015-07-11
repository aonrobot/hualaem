@extends('frontend.layout')

@section('title') Profile: {{ $user->fullname_th }} @stop

@section('css')
@parent
{{ HTML::style('frontend/css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profile</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="well">
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
                                <div class="form-group">
                                    <label for="prefix_th" class="col-sm-2 control-label">คำนำหน้า</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('prefix_th',['เด็กชาย'=>'เด็กชาย','เด็กหญิง'=>'เด็กหญิง','นาย'=>'นาย','นางสาว'=>'นางสาว'],$user->prefix_th,['class'=>'form-control']) }}
                                    </div>
                                </div>
                                {{ Form::bsInlineGroup('ชื่อ','user[firstname_th]',$user->firstname_th) }}
                                {{ Form::bsInlineGroup('นามสกุล','user[lastname_th]',$user->lastname_th) }}
                                <div class="form-group">
                                    <label for="prefix_th" class="col-sm-2 control-label">คำนำหน้า EN</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('prefix_en',['Mr.'=>'Mr.','Miss'=>'Miss'],$user->prefix_en,['class'=>'form-control']) }}
                                    </div>
                                </div>
                                {{ Form::bsInlineGroup('ชื่อ','user[firstname_en]',$user->firstname_en) }}
                                {{ Form::bsInlineGroup('นามสกุล','user[lastname_en]',$user->lastname_en) }}
                                {{ Form::bsInlineGroup('ชื่อเล่น','user[nickname]',$user->nickname) }}
                                {{ Form::bsInlineGroup('วันเกิด','user[birthdate]',$user->birthdate) }}
                                {{ Form::bsInlineGroup('เลขประจำตัวประชาชน','user[citizen_id]',$user->citizen_id) }}
                                {{ Form::bsInlineGroup('มือถือ','user[mobile_no]',$user->mobile_no) }}
                                {{ Form::bsInlineGroup('อีเมล์','user[email]',$user->email) }}
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
</div>

@stop

@section('js_foot')
@parent

{{ HTML::script('frontend/js/moment.min.js') }}
{{ HTML::script('frontend/js/bootstrap-datetimepicker.min.js') }}

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

{{ HTML::script('frontend/js/angular.min.js') }}
{{ HTML::script('angular_modules/user_form.js') }}

@stop