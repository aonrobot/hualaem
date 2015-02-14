@extends('frontend.layout')

@section('title') List User @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>User List</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>StudentID</th>
                        <th>role</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->full_name_th }}</td>
                        <td>{{ $user->student_id }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->mobile_no }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        {{ $users->links() }}
    </div>
</div>
@stop

@section('js_foot')
@parent

@stop