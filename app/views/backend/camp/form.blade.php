@extends('backend.layout')

@section('title') Add New Camp @stop

@section('css')
@parent
{{ HTML::style('backend/css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<form class="form-horizontal" action="{{ empty($camp) ? URL::route('admin.camp.save') : URL::route('admin.camp.save',[$camp->id]) }}" method="POST" enctype="multipart/form-data">
    <div  ng-app="CampForm">
        <div class="row">
            <div class="col-md-12">
                <h1>Add New Camp</h1>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Secton 1 | Camp Detail Page
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        {{ Form::bsInlineGroup('Camp Name','name',$camp->name) }}
                        {{ Form::bsInlineGroup('Type','type',$camp->type) }}
                        {{ Form::bsSelectLevel($levels,'ระดับ','level_id',$camp->level_id) }}
                        {{ Form::bsInlineGroup('Register Start','register_start',empty($camp->register_start) ? date('Y-m-d') : $camp->register_start) }}
                        {{ Form::bsInlineGroup('Register End','register_end',$camp->register_end) }}
                        {{ Form::bsInlineGroup('Camp Start','camp_start',$camp->camp_start) }}
                        {{ Form::bsInlineGroup('Camp End','camp_end',$camp->camp_end) }}
                        {{ Form::bsInlineGroup('Place','place',$camp->place) }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="province_id">จังหวัด</label>
                            <div class="col-sm-10">
                                {{ Form::select('province_id', $provinces, $camp->province_id, [ 'class'=> "form-control"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="image">รูปภาพ</label>
                            <div class="col-sm-10">
                                <img src="{{$camp->image_path}}" class="img-thumbnail" id="img-preview">
                                <br>
                                {{ Form::file('image',['id'=>'image']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="description">คำอธิบาย</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('description',$camp->description,['class'=>"form-control"]) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <field-list></field-list>

        <subject-list></subject-list>
    </div>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-info col-xs-12" value="Save">
            </div>
        </div>

</form>
@stop

@section('js_foot')
@parent
{{ HTML::script('backend/js/moment.min.js') }}
{{ HTML::script('backend/js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('ckeditor/ckeditor.js') }}

<script>
    var savedData = {
        subjects: {{ empty($camp) || empty($camp->subjects)  ? json_encode(Input::old('subjects',[])) : json_encode($camp->subjects) }},
        fields: {{ empty($camp) || empty($camp->fields) ? json_encode(Input::old('fields',[])) : json_encode($camp->fields) }}
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

        $('#image').change(function(){
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        });

        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ URL::route('admin.upload.file') }}",
            filebrowserImageUploadUrl: "{{ URL::route('admin.upload.image') }}"
        });
    });

</script>
{{ HTML::script('backend/js/angular.min.js') }}
{{ HTML::script('angular_modules/camp_form.js') }}

@stop