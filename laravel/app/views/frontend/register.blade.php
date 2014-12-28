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
                    <!-- Form for Register -->
                    <form class="w-clearfix" id="email-form-2" name="form-register" data-name="Register Form">
                        <div class="w-row">
                            <div class="w-col w-col-6">
                                <div class="text regis_col_name">ข้อมูลพื้อฐาน</div>
                                <div class="div register_block">
                                    <label class="label register" for="user">ชื่อผู้ใช้</label>
                                    <input class="w-input" id="user" type="text" placeholder="Username" name="user" required="required" autofocus="autofocus" data-name="user">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="password-2">รหัสผ่าน</label>
                                    <input class="w-input" id="password-2" type="password" placeholder="Password" name="password" required="required" data-name="password">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="re_password">ยืนยันรหัสผ่าน</label>
                                    <input class="w-input" id="re_password" type="text" placeholder="Retype-Password" name="re_password" required="required" data-name="re_password">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="email">อีเมลล์</label>
                                    <input class="w-input" id="email" type="email" placeholder="Email" name="email" required="required" data-name="email">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="name">ชื่อ</label>
                                    <input class="w-input" id="name" type="text" placeholder="Name" name="name" required="required" data-name="name">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="surname">นามสกุล</label>
                                    <input class="w-input" id="surname" type="text" placeholder="Surname" name="surname" required="required" data-name="surname">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="nick">ชื่อเล่น</label>
                                    <input class="w-input" id="nick" type="text" placeholder="Nickname" name="nick" required="required" data-name="nick">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="school">ปัจจุบันศึกษาที่</label>
                                    <input class="w-input" id="school" type="text" placeholder="Current Education" name="school" required="required" data-name="school">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="level">ชั้น</label>
                                    <input class="w-input" id="level" type="text" placeholder="Level" name="level" required="required" data-name="level">
                                </div>
                            </div>
                            <div class="w-col w-col-6">
                                <div class="text regis_col_name">ที่อยู่</div>
                                <div class="div register_block">
                                    <label class="label register" for="house_no">บ้านเลขที่</label>
                                    <input class="w-input" id="house_no" type="text" placeholder="House No." name="house_no" required="required" data-name="house_no">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="road">ถนน</label>
                                    <input class="w-input" id="road" type="text" placeholder="Road" name="road" required="required" data-name="road">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="village">หมู่</label>
                                    <input class="w-input" id="village" type="text" placeholder="Village No." name="village" required="required" data-name="village">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="sub_district">ตำบล</label>
                                    <input class="w-input" id="sub_district" type="text" placeholder="Sub-District" name="sub_district" required="required" data-name="sub_district">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="district">อำเภอ</label>
                                    <input class="w-input" id="district" type="text" placeholder="District" name="district" required="required" data-name="district">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="province">จังหวัด</label>
                                    <input class="w-input" id="province" type="text" placeholder="Province" name="province" required="required" data-name="province">
                                </div>
                                <div class="div register_block">
                                    <label class="label register" for="phone">เบอร์โทรศัพท์</label>
                                    <input class="w-input" id="phone" type="text" placeholder="Phone" name="phone" required="required" data-name="phone">
                                </div>
                            </div>
                        </div>
                        <input class="w-button button green register" type="submit" value="Register" data-wait="Please wait...">
                    </form>
                    <!-- Form for Register -->


                    <div class="w-form-done">
                        <p>Thank you!</p>
                    </div>
                    <div class="w-form-fail">
                        <p>Oops! Something went wrong while submitting the form :(</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop