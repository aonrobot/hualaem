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
                    <form id="email-form" name="email-form" data-name="Email Form">
                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="checkbox" type="checkbox" name="checkbox" data-name="Checkbox">
                            <label class="w-form-label" for="checkbox">Name</label>
                        </div>
                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="checkbox-4" type="checkbox" name="checkbox-4" data-name="Checkbox 4">
                            <label class="w-form-label" for="checkbox-4">Surname</label>
                        </div>
                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="checkbox-3" type="checkbox" name="checkbox-3" data-name="Checkbox 3">
                            <label class="w-form-label" for="checkbox-3">Email</label>
                        </div>
                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="checkbox-2" type="checkbox" name="checkbox-2" data-name="Checkbox 2">
                            <label class="w-form-label" for="checkbox-2">Phone</label>
                        </div>
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