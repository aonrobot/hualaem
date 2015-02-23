@extends('backend.layout')

@section('title') Add/Edit News @stop

@section('css')
@parent
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
<form class="form-horizontal" action="{{ empty($news) ? URL::route('admin.news.save') : URL::route('admin.news.save',[$news->id]) }}" method="POST" enctype="multipart/form-data">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Add/Edit News</h1>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        {{ Form::bsInlineGroup('News Name','name',$news->name) }}
                        <div class="form-group">
                            <label for="excerpt" class="col-sm-2 control-label">Excerpt</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('excerpt',$news->excerpt,['class'=>"form-control"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('detail',$news->detail,['class'=>"form-control"]) }}
                            </div>
                        </div>
                        {{ Form::bsInlineGroup('Puslish At','publish_at',empty($news->publish_at) ? date('Y-m-d H:i:s') : $news->publish_at)  }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-info col-xs-12" value="Save">
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
        $('#publish_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        
        CKEDITOR.replace('excerpt', {
            filebrowserUploadUrl: "{{ URL::route('admin.upload.file') }}",
            filebrowserImageUploadUrl: "{{ URL::route('admin.upload.image') }}"
        });

        CKEDITOR.replace('detail', {
            filebrowserUploadUrl: "{{ URL::route('admin.upload.file') }}",
            filebrowserImageUploadUrl: "{{ URL::route('admin.upload.image') }}"
        });
    });

</script>

@stop