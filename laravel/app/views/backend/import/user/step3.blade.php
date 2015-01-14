@extends('backend.layout')

@section('title') Register @stop

@section('css')
@parent
{{ HTML::style('css/table.css') }}
@show

@section('content')
<div class="section grey" data-anchor="slide1">
    <div class="w-container">
        <h1 class="page_name">Import</h1>
    </div>
</div>
<div class="section">
    <div class="w-container">
        <div class="step_bar"></div>
    </div>

    <div class="w-container content">
        <div class="content div block">
            <h1 class="menu_name">Edit Field</h1>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    @foreach($previewData as $tableName => $table)
                    <div class="w-row">
                        <h1>{{ $tableName }}</h1>
                        <table class="table-fill">
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
    <div class="w-container content">
        <div class="content div block">
            <h1 class="menu_name">Select Record</h1>
            <div class="content table"></div>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form id="email-form" name="email-form" data-name="Email Form" method="POST" action="{{ URL::action('mix5003\Hualaem\Backend\ImportUserController@getStep3') }}">
                        <div class="w-clearfix content register">
                            <input class="w-button button green finish" type="submit" value="Confirm" data-wait="Please wait...">
                        </div>
                    </form>
                    <div class="w-form-done">
                        <p>Thank you! Your submission has been received!</p>
                    </div>
                    <div class="w-form-fail">
                        <p>Oops! Something went wrong while submitting the form :(</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop