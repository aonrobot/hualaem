<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        @font-face {
            font-family: "TH Sarabun New";
            font-style: normal;
            font-weight: normal;
            src: local('TH Sarabun New'), url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: "TH Sarabun New";
            font-style: normal;
            font-weight: bold;
            src: local('TH Sarabun New'), url("{{ storage_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: "TH Sarabun New";
            font-style: italic;
            font-weight: normal;
            src: local('TH Sarabun New'), url("{{ storage_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: "TH Sarabun New";
            font-style: italic;
            font-weight: bold;
            src: local('TH Sarabun New'), url("{{ storage_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body, body *{
            font-family: "TH Sarabun New";
        }
        .page{
            font-family: "TH Sarabun New";
            page-break-before: always;
        }
        .page:first-child{
            page-break-before:inherit;
        }
        h1, p{
            margin:0;
            padding:0;
        }

    </style>
</head>
<body>
@foreach($enrolls as $enroll)
    <div class="page">
        <h1>ข้อมูลส่วนตัว</h1>
        ID {{$enroll->user->student_id }} <br>
        ชื่อ {{$enroll->user->fullname_th }} <br>
        ที่อยู่ {{$enroll->user->addresses[0]->address }} <br>
        วันเกิด {{$enroll->user->birthdate }} อายุ {{$enroll->user->age }} ปี <br>
        ชื่อเล่น {{$enroll->user->nickname }} <br>
        เบอร์โทร {{$enroll->user->molbile_no }} <br>
        อีเมล์ {{$enroll->user->email }} <br>
        <br><br>
        @if(!empty($enroll->fields[0]))
        <h1>คำถามสมัครค่าย</h1>
        <ol>
            @foreach($enroll->fields as $field)
            <li>
                <strong>{{ $field->campFields->name }}</strong>
                <p>
                @if($field->campFields->type === \CampField::TEXT)
                    {{$field->value }}
                @elseif($field->campFields->type === \CampField::TEXTAREA)
                    {{ nl2br($field->value) }}
                @elseif($field->campFields->type === \CampField::FILE)
                    <a href="{{ URL::route('admin.camp.download_application_file',[$field->id]) }}">
                        {{ URL::route('admin.camp.download_application_file',[$field->id]) }}
                    </a>
                @endif
                </p>
            </li>
            @endforeach
        </ol>
        @endif
    </div>
@endforeach
</body>
</html>