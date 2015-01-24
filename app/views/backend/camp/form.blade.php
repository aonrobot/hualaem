@extends('backend.layout')

@section('title') Add New Camp @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<form class="form-horizontal" action="{{ URL::route('admin.camp.add') }}" method="POST" enctype="multipart/form-data">
    <div  ng-app="CampForm">
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
                        <label class="col-sm-2 control-label" for="image">รูปภาพ</label>
                        <div class="col-sm-10">
                            {{ Form::file('image',['id'=>'image']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">คำอธิบาย</label>
                        <div class="col-sm-10">
                            {{ Form::textarea('description',null,['class'=>"form-control"]) }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <field-list></field-list>

        <subject-list></subject-list>
    </div>
    <div class="container">
        <div class="row">
            <input type="submit" class="btn btn-info col-xs-12" value="ADD CAMP">
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
    var savedData = {
        subjects: {{ empty($camp) ? json_encode(Input::old('subjects',[])) : json_encode($camp->subjects) }},
        fields: {{ empty($camp) ? json_encode(Input::old('fields',[])) : json_encode($camp->fields) }}
    };
    
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

        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ URL::route('admin.upload.file') }}",
            filebrowserImageUploadUrl: "{{ URL::route('admin.upload.image') }}"
        });
    });

</script>
{{ HTML::script('js/angular.min.js') }}
{{ HTML::script('js/angular_modules/camp_form.js') }}

@stop