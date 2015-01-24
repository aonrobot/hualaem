@extends('backend.layout')

@section('title') Add New Camp @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<form class="form-horizontal">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Add New Camp</h1>
            </div>
        </div>

    </div>

    <div class="container well">
        <div class="row">
            <div class="col-md-12">
                <h2>Secton 1 | Camp Detail Page</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::bsInlineGroup('Camp Name','name') }}
                {{ Form::bsInlineGroup('Type','type') }}
                {{ Form::bsInlineGroup('ระดับ','level') }}
                {{ Form::bsInlineGroup('Register Start','register_start',null,'text',date('Y-m-d')) }}
                {{ Form::bsInlineGroup('Register End','register_end') }}
                {{ Form::bsInlineGroup('Camp Start','camp_start') }}
                {{ Form::bsInlineGroup('Camp End','camp_end') }}
                {{ Form::bsInlineGroup('Place','place') }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="province_id">จังหวัด</label>
                    <div class="col-sm-10">
                        {{ Form::select('province_id', $provinces, null, [ 'class'=> "form-control"]) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="province_id">รูปภาพ</label>
                    <div class="col-sm-10">
                        {{ Form::file('image') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="province_id">รูปภาพ</label>
                    <div class="col-sm-10">
                        {{ Form::textarea('description',null,['class'=>"form-control"]) }}
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    <div class="container well">
        <div class="row">
            <div class="col-md-12">
                <h2>Secton 2 | Register Page</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="field_lists">
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" id="btnAddField">Add Field +</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('js_foot')
@parent
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('ckeditor/ckeditor.js') }}
<script>
    $(function () {
        $('#register_start').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#register_end').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $("#register_start").on("dp.change", function (e) {
            $('#register_end').data("DateTimePicker").minDate(e.date);
        });
        $("#register_end").on("dp.change", function (e) {
            $('#register_start').data("DateTimePicker").maxDate(e.date);
        });

        $('#camp_start').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#camp_end').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $("#camp_start").on("dp.change", function (e) {
            $('#camp_end').data("DateTimePicker").minDate(e.date);
        });
        $("#camp_end").on("dp.change", function (e) {
            $('#camp_start').data("DateTimePicker").maxDate(e.date);
        });

        CKEDITOR.replace( 'description', {
            //TODO: change url
            filebrowserUploadUrl: '/uploader/upload.php',
            filebrowserImageUploadUrl: '/uploader/upload.php?type=Images'
        });
        
        
        var field_lists = $('#field_lists');
        var field_count = 0;
        $('#btnAddField').click(function(){
            field_lists.append('\
<div class="row">\n\
    <div class="col-xs-9"><input class="form-control input-sm" name="fields['+field_count+'][name]" placeholder="Field Name"></div>\n\
    <div class="col-xs-3">\n\
        <select name="fields['+field_count+'][type]" class="form-control input-sm">\n\
            <option value="text">Single Line</option>\n\
            <option value="textarea">Multi Line</option>\n\
            <option value="file">File</option>\n\
        </select>\n\
        <br>\n\
    </div>\n\
</div>');
            field_count++;
        });
    });

</script>
@stop