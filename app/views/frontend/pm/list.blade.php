@extends('frontend.layout')

@section('title') Private Message List @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Private Message</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Topic</th>
                        <th width="300">Post By</th>
                        <th width="150">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pms as $obj)
                    <tr class="{{ $obj->last_open == null || $obj->last_open < $obj->updated_at ? 'pm_unread' : '' }}">
                        <td>{{ $obj->group->id }}</td>
                        <td>
                            <a href="{{ URL::route('user.pm.view', [$obj->group->id] ) }}">
                                {{ $obj->group->topic }}
                            </a>
                        </td>
                        <td>
                            @if($obj->group->sender->id != Auth::user()->id)
                                <a href="{{ URL::route('user.profile.view',[$obj->group->sender->id]) }}">
                                {{ $obj->group->sender->fullname_th }}
                                </a>
                            @else
                                <a href="{{ URL::route('user.profile.view',[$obj->group->groupUsers()->first()->user->id]) }}">
                                {{ $obj->group->groupUsers()->first()->user->fullname_th }}

                                </a>
                            @endif
                        </td>
                        <td>{{ $obj->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        {{ $pms->appends(Input::except('page'))->links() }}
    </div>
</div>
@stop
