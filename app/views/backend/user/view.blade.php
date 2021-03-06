@extends('backend.layout')

@section('title') Profile: {{ $user->fullname_th }} @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Profile</h1>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $user->fullname_th }}
            @if($user->role == 'VERIFIED')
                <span class="glyphicon glyphicon-ok"></span>
            @elseif($user->role == 'UNVERIFIED')
                <span class="glyphicon glyphicon-remove"></span>
            @endif
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
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
                        Student ID: {{ $user->student_id }}<br>
                        ชื่อ: {{ $user->firstname_th }}<br>
                        นามสกุล: {{ $user->lastname_th }}<br>
                        Firstname: {{ $user->prefix_en }} {{ $user->firstname_en }}<br>
                        Lastname: {{ $user->lastname_en }}<br>
                        ชื่อเล่น: {{ $user->nickname }}<br>
                        วันเกิด: {{ $user->birthdate }}
                        @if($user->birthdate != NULL)
                            ( {{ $user->age }} Years)
                        @endif
                        <br>
                        เลขประจำตัวประชาชน: {{ $user->citizen_id }}<br>
                        มือถือ: {{ $user->mobile_no }}<br>
                        อีเมล์: {{ $user->email }}<br>

                        <div class="pull-right">
                            <a href="{{ URL::route('admin.user.edit',[$user->id]) }}" class="btn btn-info">Edit Profile</a>
                        </div>
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
        </div>
        <!-- /.panel-body -->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Camp Register
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @foreach($registerCamps as $k1 => $enroll)
                            @if($k1 % 2 == 0)
                            <div class="row">
                            @endif
                                @include('frontend.partials.camp_circle',['class'=>'col-md-6','camp'=>$enroll->camp])
                            @if($k1 % 2 == 1)
                            </div>
                            @endif
                    @endforeach
                    @if(isset($k1) && $k1 % 2 == 0)
                        {{ "</div>" }}
                    @endif
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Camp History
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @foreach($historyCamps as $k2 => $enroll)
                            @if($k2 % 2 == 0)
                            <div class="row">
                            @endif
                                @include('frontend.partials.camp_circle',['class'=>'col-md-6','camp'=>$enroll->camp])
                            @if($k2 % 2 == 1)
                            </div>
                            @endif
                    @endforeach
                    @if(isset($k2) && $k2 % 2 == 0)
                        {{ "</div>" }}
                    @endif
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            History
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <table class="table table-condensed table-striped table-bordered">
                <thead>
                <tr>
                    <th>เวลา</th>
                    <th>ชนิด</th>
                    <th>ฟิลด์</th>
                    <th>ค่าเก่า</th>
                    <th>ค่าใหม่</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userLogs as $log)
                    <tr>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->target_type }}</td>
                        <td>{{ $log->field }}</td>
                        <td>{{ $log->old_value }}</td>
                        <td>{{ $log->new_value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.panel-body -->
    </div>

@stop

@section('js_foot')
@parent

@stop