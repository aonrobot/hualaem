@extends('frontend.layout')

@section('title') Profile: {{ $user->fullname_th }} @stop

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
                <a href="{{ URL::route('user.pm.create',[$user->id]) }}" class="btn btn-info pull-right">
                    <span class="glyphicon glyphicon-envelope"></span>
                </a>
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
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    @if(Auth::user()->id == $user->id)
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
                    @endif

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

                            @if(Auth::user()->id == $user->id)
                            <div class="pull-right">
                                <a href="{{ URL::route('user.profile.edit') }}" class="btn btn-info">Edit Profile</a>
                            </div>
                            @endif
                        </div>
                        @if(Auth::user()->id == $user->id)
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
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Camp Registered</h2>
                    </div>
                </div>

                @foreach($registerCamps as $k => $enroll)
                @if($k % 2 == 0)
                <div class="row">
                @endif
                    @include('frontend.partials.camp_circle',['class'=>'col-md-6','camp'=>$enroll->camp])
                @if($k % 2 == 1)
                </div>
                @endif
                @endforeach
                @if(isset($k) && $k % 2 == 0)
                {{ "</div>" }}
                @endif
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Camp History</h2>
                    </div>
                </div>

                @foreach($historyCamps as $k => $enroll)
                @if($k % 2 == 0)
                <div class="row">
                @endif
                    @include('frontend.partials.camp_circle',['class'=>'col-md-6','camp'=>$enroll->camp])
                @if($k % 2 == 1)
                </div>
                @endif
                @endforeach
                @if(isset($k) && $k % 2 == 0)
                {{ "</div>" }}
                @endif
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->id == $user->id)
<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <h2>History</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
</div>
@endif
@stop
