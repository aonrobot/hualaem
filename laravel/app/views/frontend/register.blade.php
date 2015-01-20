@extends('frontend.layout')

@section('title') Register @stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <img src="{{ asset('images/1415873536_user-id-64.png') }}" alt="54642fce3c195bec149176d9_1415873536_user-id-64.png">
                Register
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <div>
        <div class="well">
            <div>
                <div class="w-form">
                    @if($errors->any())
                    <div class="w-form-fail" style="display:block">
                        <ul>
                            @foreach ($errors->all('<li>:message</li>') as $message)
                            {{ $message }}
                            @endforeach
                        </ul>
                    </div>
                    <br>
                    @endif
                    <!-- Form for Register -->
                    <form  id="email-form-2" name="form-register" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text regis_col_name">ข้อมูลพื้นฐาน</div>
                                <div class="form-group">
                                    <label class="label register" for="username">ชื่อผู้ใช้</label>
                                    {{ Form::myInput('username','Username','text',null,['autofocus'=>'autofocus']) }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="password">รหัสผ่าน</label>
                                    {{ Form::myInput('password','Password','password') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="password_confirmation">ยืนยันรหัสผ่าน</label>
                                    {{ Form::myInput('password_confirmation','Retype-Password','password') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="email">อีเมลล์</label>
                                    {{ Form::myInput('email','Email','email') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="firstname_th">ชื่อ</label>
                                    {{ Form::myInput('firstname_th','Name') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="lastname_th">นามสกุล</label>
                                    {{ Form::myInput('lastname_th','Surname') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="nickname">ชื่อเล่น</label>
                                    {{ Form::myInput('nickname','Nickname') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="mobile_no">เบอร์มือถือ</label>
                                    {{ Form::myInput('mobile_no','Mobile No') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register">
                                        {{ HTML::image(Captcha::img(), 'Captcha image') }}
                                    </label>
                                    <input class="w-input" id="capcha" type="text" placeholder="Capcha" name="capcha" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text regis_col_name">ที่อยู่</div>
                                <div class="form-group">
                                    <label class="label register" for="house_no">บ้านเลขที่</label>
                                    {{ Form::myInput('house_no','House No.') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="road">ถนน</label>
                                    {{ Form::myInput('road','Road') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="village_no">หมู่</label>
                                    {{ Form::myInput('village_no','Village No.') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="sub_district_id">ตำบล</label>
                                    {{ Form::select('sub_district_id', $subDistricts, null, [ 'class'=> "form-control input-sm"]) }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="district_id">อำเภอ</label>
                                    {{ Form::select('district_id', $districts, null, [ 'class'=> "form-control input-sm"]) }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="province_id">จังหวัด</label>
                                    {{ Form::select('province_id', $provinces, null, [ 'class'=> "form-control input-sm"]) }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="postcode">รหัสไปรษณีย์</label>
                                    {{ Form::myInput('postcode','Postcode') }}
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="phone_no">เบอร์โทรศัพท์</label>
                                    {{ Form::myInput('phone_no','Phone') }}
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-info register" type="submit" value="Register">
                    </form>
                    <!-- Form for Register -->


                </div>
            </div>
        </div>
    </div>
</div>

@stop