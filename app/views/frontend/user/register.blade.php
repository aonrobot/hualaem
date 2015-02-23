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
                                    <label class="label register" for="province_id">จังหวัด</label>
                                    <select name="province_id" id="province_id" class="form-control input-sm">
                                        <option value=""></option>
                                        @foreach($provinces as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="district_id">อำเภอ</label>
                                    <select name="district_id" id="district_id" class="form-control input-sm">
                                        <option value=""></option>
                                        @foreach($districts as $key => $val)
                                        <option value="{{ $key }}" data-parent="{{ $val['parent_id'] }}">{{ $val['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="label register" for="sub_district_id">ตำบล</label>
                                    <select name="sub_district_id" id="sub_district_id" class="form-control input-sm">
                                        <option value=""></option>
                                        @foreach($subDistricts as $key => $val)
                                        <option value="{{ $key }}" data-parent="{{ $val['parent_id'] }}">{{ $val['name'] }}</option>
                                        @endforeach
                                    </select>
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

@section('js_foot')
@parent
<script>
    $(document).ready(function () {
        function setDisable(obj, val) {
            if (val) {
                obj.attr('disabled', 'disabled');
            } else {
                obj.removeAttr('disabled');
            }
        }

        function makeHideable(parentObj, childObj,additionCallback) {
            var objs = [];
            var oldValues = childObj.find('option').each(function(){
                objs.push({
                    val: this.value,
                    text: this.innerHTML,
                    parent: $(this).data('parent')
                });
            });
            
            setDisable(childObj, true);

            parentObj.change(function () {
                var my_id = parentObj.val();
                if (!my_id) {
                    setDisable(childObj, true);
                    return;
                }

                var html = '';
                for(var i = 0,l=objs.length;i<l;i++){
                    var obj = objs[i];
                    var parent = obj.parent;
                    if(parent == '' || parent == my_id){
                        html += '<option value="'+obj.val+'">'+obj.text+'</option>';
                    }
                }
                childObj.html(html);
                childObj.val('');
                setDisable(childObj, false);
                
                if(additionCallback){
                    additionCallback();
                }
            });
        }

        makeHideable($('#province_id'), $('#district_id'),function(){
            $('#sub_district_id').val('');
            setDisable($('#sub_district_id'),true);
        });
        makeHideable($('#district_id'), $('#sub_district_id'));
    });
</script>
@stop