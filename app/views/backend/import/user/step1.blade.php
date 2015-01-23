@extends('backend.layout')

@section('title') Register @stop

@section('content')
<div class="section grey">
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
            <h1 class="menu_name">CSV Unicode Text (First colum must be student id)</h1>
            <div class="content camp_detail">
                <div class="form form register_camp">
                    <form method="POST" action="{{ URL::route('admin.import.step1') }}" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-2"><label for="file_person">Personal Info</label></div>
                            <div class="col-md-8">
                                <input class="form-control" id="name_person" type="text" name="file_name" required="required" disabled="disabled" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <input type="file" id="file_person" name="file_person" style="display:none;" required="required" autocomplete="off">
                                <div class="w-clearfix content register">
                                    <button class="btn btn-default  select_file" id="btnSelPerson">Select File</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"><label for="file_school">School History</label></div>
                            <div class="col-md-8">
                                <input class="form-control" id="name_school" type="text" name="file_name" required="required" disabled="disabled" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <input type="file" id="file_school" name="file_school" style="display:none;" required="required" autocomplete="off">
                                <div class="w-clearfix content register">
                                    <button class="btn btn-default  select_file" id="btnSelSchool">Select File</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"><label for="file_camp">Camp History</label></div>
                            <div class="col-md-8">
                                <input class="form-control" id="name_camp" type="text" name="file_name" required="required" disabled="disabled" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <input type="file" id="file_camp" name="file_camp" style="display:none;" required="required" autocomplete="off">
                                <div class="w-clearfix content register">
                                    <button class="btn btn-default  select_file" id="btnSelCamp">Select File</button>
                                </div>
                            </div>
                        </div>


                        <div class="w-clearfix content register">
                            <input class="btn btn-info next_step" type="submit" value="Next Step" data-wait="Please wait...">
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
        $('#btnSelPerson').click(function () {
            $('#file_person').click();
            return false;
        });
        $('#file_person').change(function () {
            $('#name_person').val(this.files[0].name);
        });
        
        $('#btnSelSchool').click(function () {
            $('#file_school').click();
            return false;
        });
        $('#file_school').change(function () {
            $('#name_school').val(this.files[0].name);
        });
        
        $('#btnSelCamp').click(function () {
            $('#file_camp').click();
            return false;
        });
        $('#file_camp').change(function () {
            $('#name_camp').val(this.files[0].name);
        });
    })(jQuery);
</script>
@stop