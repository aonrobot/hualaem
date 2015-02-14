<?php

return [
    'admin_user_import' => [
        //CSV Type
        'person' => [
            //Table
            'users' => [
                //FieldName => Label
                'username' => 'Username',
                //'student_id' => 'Student ID',
                'citizen_id' => 'เลขประจำตัวประชาชน',
                'prefix_th' => 'คำนำหน้า',
                'firstname_th' => 'ชื่อ',
                'lastname_th' => 'สกุล',
                'prefix_en' => 'Prefix',
                'firstname_en' => 'Firstname',
                'lastname_en' => 'Lastname',
                'mobile_no' => 'มือถือ',
                'email' => 'Email',
                'nickname' => 'ชื่อเล่น',
                'birthdate' => 'วันเกิด',
                'created_at' => 'วันที่สมัคร',
            ],
            'addresses' => [
                'house_no' => 'บ้านเลขที่',
                'road' => 'ถนน',
                'village_no' => 'หมู่',
                'village' => 'หมูบ้าน',
                'sub_district' => 'แขวง',
                'district' => 'เขต',
                'province' => 'จังหวัด',
                'postcode' => 'รหัสไปรษณีย์',
                'phone_no' => 'เบอร์บ้าน',
            ],
            'father' => [
                'prefix_th' => 'คำนำหน้า',
                'firstname_th' => 'ชื่อ',
                'lastname_th' => 'สกุล',
                'mobile_no' => 'มือถือ',
                'email' => 'Email',
                'job' => 'อาชีพ',
                'job_title' => 'ตำแหน่ง/เจ้าของ',
                'job_type' => 'ทำงานด้านไหน หรือ กิจการอะไร',
            ],
            'mother' => [
                'prefix_th' => 'คำนำหน้า',
                'firstname_th' => 'ชื่อ',
                'lastname_th' => 'สกุล',
                'mobile_no' => 'มือถือ',
                'email' => 'Email',
                'job' => 'อาชีพ',
                'job_title' => 'ตำแหน่ง/เจ้าของ',
                'job_type' => 'ทำงานด้านไหน หรือ กิจการอะไร',
            ],
        ],
        //
        'school' => [
            'school' => [
                'name' => 'ชื่อสถานศึกษา'
            ],
            'semester' => [
                'name' => 'ชื่อสถานศึกษา',
                'year' => 'ปีการศึกษา',
                'level' => 'ระดับชั้น',
                'semester' => 'เทอมที่'
            ]
        ],
        //
        'camp' => [
            'camp' => [
                'name' => 'หลักสูตร',
                'type' => 'ประเภท',
                'level' => 'ช่วงชั้น',
                'camp_start' => 'วันที่เริ่ม',
                //'camp_end'=>'',
                'place' => 'สถานที่',
                'province' => 'จังหวัด',
                'role' => 'บทบาท',
            ],
        ]
    ]
];
