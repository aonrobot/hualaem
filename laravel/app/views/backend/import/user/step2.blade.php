@extends('backend.layout')

@section('title') Register @stop

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
            <h1 class="menu_name">Select Field</h1>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form class="w-form" action="{{ URL::action('mix5003\Hualaem\Backend\ImportUserController@getStep2') }}" method="POST">
                        @foreach($importable as $keyType => $types)
                        <div>
                            @foreach($types as $type => $fields)
                            <div class="w-row">
                                <div class="w-col w-col-12">
                                    <h2>{{ $type }}</h2>
                                </div>
                            </div>
                            <div class="w-row">
                                <div class="w-col w-col-12">
                                    @foreach($fields as $field => $label)
                                    <div class="w-row">
                                        <div class="w-col w-col-6">
                                            <label>{{ $label }}</label>
                                        </div>
                                        <div class="w-col w-col-6">
                                            <select class="w-select" name="{{$type}}.{{$field}}">
                                                <option value="">-- None --</option>
                                                @foreach($cols[$keyType] as  $index =>  $csvField)
                                                <option value="{{ $index }}">{{ $index + 1 }}. {{$csvField}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        <div class="w-clearfix content register">
                            <input class="w-button button blue next_step" value="Next Step"  type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="w-container content">
        <div class="content div block">
            <h1 class="menu_name">Edit Field</h1>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form id="email-form" name="email-form" data-name="Email Form">
                        <label for="email-5">Name :</label>
                        <input class="w-input" id="email-5" type="email" placeholder="Enter your email address" name="email-5" data-name="Email 5" required="required">
                        <div class="w-clearfix content register">
                            <input class="w-button button blue next_step" type="submit" value="Next Step" data-wait="Please wait...">
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
    <div class="w-container content">
        <div class="content div block">
            <h1 class="menu_name">Select Record</h1>
            <div class="content table"></div>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form id="email-form" name="email-form" data-name="Email Form">
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