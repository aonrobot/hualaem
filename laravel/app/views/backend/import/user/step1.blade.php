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
            <h1 class="menu_name">Excel / CSV</h1>
            <div class="content camp_detail">
                <div class="w-form form register_camp">
                    <form id="email-form" name="email-form" data-name="Email Form">
                        <label for="email-4">Excel/CSV File :</label>
                        <input class="w-input" id="file_name" type="text" name="file_name" required="required" disabled="disabled">
                        <input type="file" id="file" name="file" style="display:none;">
                        <div class="w-clearfix content register">
                            <button class="w-button button green select_file" id="btnSelFile">Select File</button>
                        </div>
                        <div class="w-clearfix content register">
                            <input class="w-button button blue next_step" type="submit" value="Next Step" data-wait="Please wait...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js_foot')
@parent
<script>
    (function ($) {
        $('#btnSelFile').click(function () {
            $('#file').click();
            return false;
        });
        $('#file').change(function () {
            $('#file_name').val(this.files[0].name);
        });
    })(jQuery);
</script>
@stop