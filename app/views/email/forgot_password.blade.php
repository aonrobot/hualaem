<!doctype html>
<html>
<head>

</head>
<body>
<a href="{{ URL::route('guest.forget.set_password') }}/{{ $user['id'] }}/{{ $user['recovery_token'] }}">กรุณาคลิกที่ลิงค์นี้เพื่อเปลี่ยนรหัสผ่าน</a>
</body>
</html>