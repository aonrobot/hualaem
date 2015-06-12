@extends('backend.layout')

@section('title') News List @stop

@section('css')
@parent
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>News List <a href="{{ URL::route('admin.news.add') }}" class="btn btn-info btn-sm">Add</a></h1>
    </div>
</div>

<div class="row">
    <form method="GET" id="searchForm">
        <div class="col-md-3">
            <input class="form-control input-sm" placeholder="Search By Title" name="txtSearchTitle" id="txtSearchTitle" value="{{ Input::get('txtSearchTitle') }}">
        </div>
    </form>
</div>

<br>


<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Post By</th>
                    <th>Puslish At</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <a href="{{ URL::route('admin.news.edit',[$obj->id]) }}">
                            {{ $obj->name }}
                        </a>
                    </td>
                    <td>{{ $obj->user->fullname_th }} ( User: {{ $obj->user->id }} )</td>
                    <td>{{ $obj->publish_at }}</td>
                    <td>{{ $obj->created_at }}</td>
                    <td>{{ $obj->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    {{ $news->appends(Input::except('page'))->links() }}
</div>

@stop

@section('js_foot')
@parent

@stop