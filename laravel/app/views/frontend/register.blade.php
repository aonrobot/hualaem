@extends('frontend.layout')

@section('title') Register @stop

@section('content')

<div class="w-container">
    <div class="w-row">
        <div class="w-col w-col-1 w-clearfix"><img class="icon _48 feed" src="{{ asset('images/1415873536_user-id-64.png') }}" alt="54642fce3c195bec149176d9_1415873536_user-id-64.png">
        </div>
        <div class="w-col w-col-11">
            <h1 class="heading feed">Register</h1>
        </div>
    </div>
</div>
<div class="w-container">
    <div>
        <div class="content div block register">
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
                    <form class="w-clearfix" id="email-form-2" name="form-register" method="POST">
                        <div class="w-row">
                            <div class="w-col w-col-6">
                                <div class="text regis_col_name">ข้อมูลพื้อฐาน</div>
                                <div class="div register_block">
                                    <label class="label register" for="username">ชื่อผู้ใช้</label>
                                    {{ Form::myInput('username','Username','text',null,['autofocus'=>'autofocus']) }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="password">รหัสผ่าน</label>
                                    {{ Form::myInput('password','Password','password') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="password_confirmation">ยืนยันรหัสผ่าน</label>
                                    {{ Form::myInput('password_confirmation','Retype-Password','password') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="email">อีเมลล์</label>
                                    {{ Form::myInput('email','Email','email') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="firstname_th">ชื่อ</label>
                                    {{ Form::myInput('firstname_th','Name') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="lastname_th">นามสกุล</label>
                                    {{ Form::myInput('lastname_th','Surname') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="nickname">ชื่อเล่น</label>
                                    {{ Form::myInput('nickname','Nickname') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="mobile_no">เบอร์มือถือ</label>
                                    {{ Form::myInput('mobile_no','Mobile No') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register">
                                        {{ HTML::image(Captcha::img(), 'Captcha image') }}
                                    </label>
                                    <input class="w-input" id="capcha" type="text" placeholder="Capcha" name="capcha" required="required">
                                </div>
                            </div>
                            <div class="w-col w-col-6">
                                <div class="text regis_col_name">ที่อยู่</div>
                                <div class="div register_block">
                                    <label class="label register" for="house_no">บ้านเลขที่</label>
                                    {{ Form::myInput('house_no','House No.') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="road">ถนน</label>
                                    {{ Form::myInput('road','Road') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="village_no">หมู่</label>
                                    {{ Form::myInput('village_no','Village No.') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="sub_district_id">ตำบล</label>
                                    {{ Form::select('sub_district_id', $subDistricts, null, [ 'class'=> "w-input"]) }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="district_id">อำเภอ</label>
                                    {{ Form::select('district_id', $districts, null, [ 'class'=> "w-input"]) }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="province_id">จังหวัด</label>
                                    {{ Form::select('province_id', $provinces, null, [ 'class'=> "w-input"]) }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="postcode">รหัสไปรษณีย์</label>
                                    {{ Form::myInput('postcode','Postcode') }}
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="phone_no">เบอร์โทรศัพท์</label>
                                    {{ Form::myInput('phone_no','Phone') }}
                                </div>
                            </div>
                        </div>
                        <input class="w-button button green register" type="submit" value="Register" data-wait="Please wait...">
                    </form>
                    <!-- Form for Register -->


                    <div class="w-form-done">
                        <p>Thank you!</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@stop