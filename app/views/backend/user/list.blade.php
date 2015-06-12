@extends('backend.layout')

@section('title') User List @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>User List</h1>
        </div>
    </div>

    <div class="row">
        <form method="GET" id="searchForm">
            <div class="col-md-3">
                <input class="form-control input-sm" placeholder="Search By Username" name="txtSearchUser" id="txtSearchUser" value="{{ Input::get('txtSearchUser') }}">
            </div>
            <div class="col-md-3">
                <input class="form-control input-sm" placeholder="YYYY-MM-DD"  name="txtSearchDate" id="txtSearchDate" value="{{ Input::get('txtSearchDate') }}">
            </div>
        </form>
    </div>

    <br>


<form method="POST" action="{{ URL::route('admin.user.mass_update_user') }}">

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th></th>
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
                            <td><input type="checkbox" name="selects[]" value="{{ $user->id }}"></td>
                            <td>
                                <a href="{{ URL::route('admin.user.view',[$user->id]) }}">
                                    {{ $user->fullname_th }}
                                </a>
                            </td>
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
        
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="action" value="VERIFIED" class="btn btn-info">VERIFIED SELECT USER</button>
                <button type="submit" name="action" value="UNVERIFIED" class="btn btn-info">UNVERIFIED SELECT USER</button>
            </div>
        </div>

</form>


    <div class="row">
        {{ $users->appends(Input::except('page'))->links() }}
    </div>

@stop

@section('js_foot')
@parent

{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}

<script>
    (function () {
        $('#txtSearchDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#txtSearchDate').on('dp.change', function () {
            $('#searchForm').submit();
        });
    })();

</script>
@stop