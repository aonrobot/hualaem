@extends('backend.layout')

@section('title') Register @stop

@section('css')
@parent
{{ HTML::style('css/table.css') }}
@show

@section('content')
<div class="section grey" data-anchor="slide1">
    <div class="container">
        <h1 class="page_name">Import</h1>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="step_bar"></div>
    </div>

    <div class="container content">
        <div class="content div block">
            <h1 class="menu_name">Edit Field</h1>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    @foreach($previewData as $tableName => $table)
                    <div class="row">
                        <h1>{{ $tableName }}</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach(array_keys($table[0]) as $header)
                                    <th class="text-left">{{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @foreach($table as $row)
                                <tr>
                                    @foreach($row as $val)
                                    <td class="text-left">{{ $val }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container content">
        <div class="content div block">
            <h1 class="menu_name">Select Record</h1>
            <div class="content table"></div>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form id="email-form" name="email-form" data-name="Email Form" method="POST" action="{{ URL::action('mix5003\Hualaem\Backend\ImportUserController@getStep3') }}">
                        <div class="w-clearfix content register">
                            <input class="btn btn-info finish" type="submit" value="Confirm" data-wait="Please wait...">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@stop