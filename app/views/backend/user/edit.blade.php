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
            <form method="POST" class="form-horizontal">
                <div role="tabpanel">

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
                                @foreach($user->addresses as $key => $address)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="control_address_{{$address->id}}">
                                        <h4 class="panel-title">
                                            <a class="{{ $key == 0 ? '' : 'collapsed'}}" data-toggle="collapse" data-parent="#accordion" href="#address_{{$address->id}}" aria-expanded="true" aria-controls="address_{{$address->id}}">
                                                {{$address->name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="address_{{$address->id}}" class="panel-collapse collapse {{ $key == 0 ? 'in' : ''}}" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            บ้านเลขที่: {{$address->house_no}}<br>
                                            ถนน: {{$address->road}}<br>
                                            หมู่: {{$address->village_no}}<br>
                                            แขวง: {{ isset($address->subDistrict) ? $address->subDistrict->name : ''}}<br>
                                            เขต: {{ isset($address->district) ? $address->district->name : ''}}<br>
                                            จังหวัด: {{ isset($address->province) ? $address->province->name : ''}}<br>
                                            รหัสไปรษณีย์: {{$address->postcode}}<br>
                                            เบอร์โทร: {{$address->phone_no}}<br>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="parents">
                            @foreach($user->parents as $key => $parent)
                            <div class="panel panel-default">
                                <div class="panel-heading">{{ $parent->relation }}</div>
                                <div class="panel-body">
                                    ชื่อ: {{ $parent->fullname_th }}<br>
                                    เบอร์โทร: {{ $parent->mobile_no }}<br>
                                    อาชีพ: {{ $parent->job }}<br>
                                    ตำแหน่ง: {{ $parent->job_title }}<br>
                                    ทำงานด้าน: {{ $parent->job_type }}<br>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                
                <div class="pull-right">
                    <button type="submit" class="btn btn-success">Save Change</button>
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
    (function () {
        $('#user\\[birthdate\\]').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    })();

</script>
@stop