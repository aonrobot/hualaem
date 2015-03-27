@extends('backend.layout')

@section('title') Private Message List @stop

@section('css')
@parent
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Private Message</h1>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Topic</th>
                        <th>Post By</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pms as $obj)
                    <tr>
                        <td>{{ $obj->id }}</td>
                        <td>
                            {{ $obj->group->topic }}
                        </td>
                        <td>
                            @if($obj->group->sender->id != Auth::user()->id)
                                {{ $obj->group->sender->fullanme_th }} ({{ $obj->group->sender->username }})
                            @else
                                {{ $obj->group->groupUsers()->first()->sender->fullanme_th }} ({{ $obj->group->groupUsers()->first()->sender->username }})
                            @endif
                        </td>
                        <td>{{ $obj->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        {{ $pms->appends(Input::except('page'))->links() }}
    </div>
</div>
@stop

@section('js_foot')
@parent

@stop